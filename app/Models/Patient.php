<?php
// app/models/Patient.php
require_once __DIR__ . '/../config/database.php';

class Patient {
    private $conn;
    public function __construct(){
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll(){
        $sql = "SELECT PatientID, PatientCode, FullName, DOB, Gender, Phone, Address FROM dbo.Patient ORDER BY PatientID DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function create($data){
        $sql = "INSERT INTO dbo.Patient (PatientCode, FullName, DOB, Gender, Phone, Address)
                VALUES (:PatientCode, :FullName, :DOB, :Gender, :Phone, :Address)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}
?>