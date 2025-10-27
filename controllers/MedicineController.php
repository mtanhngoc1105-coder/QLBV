<?php
// app/controllers/MedicineController.php
require_once __DIR__ . '/../models/Medicine.php';

class MedicineController {
    public function index(){
        $m = new Medicine();
        $meds = $m->getAll();
        include __DIR__ . '/../../views/medicines/list.php';
    }
}
?>