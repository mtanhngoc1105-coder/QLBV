<?php
// app/controllers/PatientController.php
require_once __DIR__ . '/../models/Patient.php';

class PatientController {
    public function index(){
        $model = new Patient();
        $patients = $model->getAll();
        include __DIR__ . '/../../views/patients/list.php';
    }

    public function store(){
        $model = new Patient();
        $data = [
            'PatientCode' => $_POST['PatientCode'] ?? '',
            'FullName' => $_POST['FullName'] ?? '',
            'DOB' => $_POST['DOB'] ?? null,
            'Gender' => $_POST['Gender'] ?? null,
            'Phone' => $_POST['Phone'] ?? null,
            'Address' => $_POST['Address'] ?? null
        ];
        $model->create($data);
        header('Location: /hospital/public/index.php?route=patients');
        exit;
    }
}
?>