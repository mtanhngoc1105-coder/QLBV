<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('department')->orderBy('name')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('doctors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        Doctor::create($data);

        return redirect()->route('doctors.index')->with('success', 'Thêm bác sĩ thành công');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('department', 'appointments');
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::orderBy('name')->get();
        return view('doctors.edit', compact('doctor','departments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $doctor->update($data);

        return redirect()->route('doctors.index')->with('success', 'Cập nhật bác sĩ thành công');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Xóa bác sĩ thành công');
    }
}
