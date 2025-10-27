<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DepartmentController,
    DoctorController,
    AppointmentController,
    PurchaseController,
    SupplierController,
    MedicineController,
    PatientController,
    PrescriptionController
};

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departments', DepartmentController::class);

Route::resource('doctors', DoctorController::class);

Route::resource('patients', PatientController::class);

Route::resource('appointments', AppointmentController::class);

Route::resource('prescriptions', PrescriptionController::class);

Route::resource('medicines', MedicineController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('purchases', PurchaseController::class);
