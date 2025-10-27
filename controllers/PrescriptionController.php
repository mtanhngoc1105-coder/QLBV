<?php
// app/controllers/PrescriptionController.php
require_once __DIR__ . '/../models/Prescription.php';
require_once __DIR__ . '/../models/Medicine.php';
require_once __DIR__ . '/../models/Patient.php';

class PrescriptionController {
    public function index(){
        $p = new Prescription();
        $pres = $p->getAllJoined();
        include __DIR__ . '/../../views/prescriptions/list.php';
    }

    public function create(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $code = 'PR' . rand(1000,9999);
            $patientID = $_POST['patientID'];
            $doctorID = $_POST['doctorID'];
            $items = [];
            $items[] = [
                'medicineID' => intval($_POST['medicineID']),
                'quantity' => intval($_POST['quantity']),
                'unitPrice' => floatval($_POST['unitPrice'])
            ];
            $p = new Prescription();
            try {
                $p->createPrescription($code, $patientID, $doctorID, $items);
                header('Location: /hospital/public/index.php?route=prescriptions');
                exit;
            } catch (Exception $e){
                $err = $e->getMessage();
                include __DIR__ . '/../../views/prescriptions/create.php';
            }
        } else {
            include __DIR__ . '/../../views/prescriptions/create.php';
        }
    }
}
?>