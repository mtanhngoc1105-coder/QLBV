<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\MedicineController;
use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\PrescriptionController;

// API Resources
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('patients', PatientController::class);
Route::apiResource('medicines', MedicineController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('prescriptions', PrescriptionController::class);

// Lịch sử khám bệnh
Route::get('/patients/{id}/history', [AppointmentController::class, 'getPatientHistory']);

// Giờ trống
Route::get('doctors/{id}/free-slots', [AppointmentController::class, 'getFreeSlots']);

// Đặt lịch 
Route::post('appointments/book', [AppointmentController::class, 'book']);

// Accept / Reject
Route::post('appointments/{id}/accept', [AppointmentController::class, 'accept']);
Route::post('appointments/{id}/reject', [AppointmentController::class, 'reject']);
