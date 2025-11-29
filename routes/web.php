<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('department', [DepartmentController::class, 'store']);



// Route::resource('patients', PatientController::class);

// Route::resource('appointments', AppointmentController::class);

// Route::resource('prescriptions', PrescriptionController::class);

// Route::resource('medicines', MedicineController::class);

// Route::resource('suppliers', SupplierController::class);

// Route::resource('purchases', PurchaseController::class);
