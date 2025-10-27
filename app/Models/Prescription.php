<?php
// app/models/Prescription.php
require_once __DIR__ . '/../config/database.php';

class Prescription {
    private $conn;
    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllJoined(){
        $sql = "SELECT p.PrescriptionID, p.PrescriptionCode, p.DateIssued, pt.FullName AS PatientName, d.DoctorName, m.MedicineName, pd.Quantity, pd.UnitPrice,
                (pd.Quantity * ISNULL(pd.UnitPrice,0)) AS LineTotal
                FROM dbo.Prescription p
                JOIN dbo.PrescriptionDetail pd ON p.PrescriptionID = pd.PrescriptionID
                JOIN dbo.Patient pt ON p.PatientID = pt.PatientID
                LEFT JOIN dbo.Doctor d ON p.DoctorID = d.DoctorID
                JOIN dbo.Medicine m ON pd.MedicineID = m.MedicineID
                ORDER BY p.DateIssued DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function createPrescription($code, $patientID, $doctorID, $items){
        try {
            $this->conn->beginTransaction();

            $sql = "INSERT INTO dbo.Prescription (PrescriptionCode, PatientID, DoctorID, Notes) VALUES (:code, :patientID, :doctorID, :notes)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['code'=>$code, 'patientID'=>$patientID, 'doctorID'=>$doctorID, 'notes'=>null]);
            $presID = $this->conn->lastInsertId();

            foreach($items as $it){
                $m = $this->conn->prepare("SELECT ExpiryDate, StockQuantity FROM dbo.Medicine WHERE MedicineID = :id");
                $m->execute(['id'=>$it['medicineID']]);
                $row = $m->fetch();
                if(!$row) throw new Exception('Medicine not found');
                if($row['ExpiryDate'] !== null && strtotime($row['ExpiryDate']) < time()){
                    continue;
                }
                if($row['StockQuantity'] < $it['quantity']){
                    throw new Exception('Insufficient stock for medicine ID ' . $it['medicineID']);
                }
                $ins = $this->conn->prepare("INSERT INTO dbo.PrescriptionDetail (PrescriptionID, MedicineID, Quantity, UnitPrice) VALUES (:presID, :medID, :qty, :uprice)"); 
                $ins->execute(['presID'=>$presID, 'medID'=>$it['medicineID'], 'qty'=>$it['quantity'], 'uprice'=>$it['unitPrice']]);
                $upd = $this->conn->prepare("UPDATE dbo.Medicine SET StockQuantity = StockQuantity - :qty WHERE MedicineID = :id");
                $upd->execute(['qty'=>$it['quantity'], 'id'=>$it['medicineID']]);
            }

            $this->conn->commit();
            return $presID;
        } catch (Exception $e){
            $this->conn->rollBack();
            throw $e;
        }
    }
}
?>