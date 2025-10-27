<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor','patient'])->orderBy('appointment_date','desc')->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();
        $patients = Patient::orderBy('name')->get();
        return view('appointments.create', compact('doctors','patients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Tạo lịch hẹn thành công');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('doctor','patient');
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::orderBy('name')->get();
        $patients = Patient::orderBy('name')->get();
        return view('appointments.edit', compact('appointment','doctors','patients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($data);

        return redirect()->route('appointments.index')->with('success', 'Cập nhật lịch hẹn thành công');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Xóa lịch hẹn thành công');
    }
}
