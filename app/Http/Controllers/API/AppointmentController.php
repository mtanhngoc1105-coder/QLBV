<?php

namespace App\Http\Controllers\API;

use App\Models\Appointment;
use App\Http\Requests\AppointmentCreateUpdateRequest;
use Illuminate\Http\Request;

class AppointmentController
{
    // ==========================
    // 1. Danh sách appointments (có search + pagination)
    // ==========================
    public function index()
    {
        $search = request()->input('search');

        $query = Appointment::query()
                  ->with(['patient', 'doctor.department']); // join doctor + department

        if ($search != null) {
            $query->whereHas('patient', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('doctor', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhere('date', $search);
        }

        $data = $query->paginate(10); // tăng số item nếu muốn

        return response()->json($data);
    }

    // ==========================
    // 2. Tạo mới appointment
    // ==========================
    public function store(AppointmentCreateUpdateRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        return response()->json($appointment, 201);
    }

    // ==========================
    // 3. Xem chi tiết appointment
    // ==========================
    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor.department'])->findOrFail($id);

        return response()->json($appointment);
    }

    // ==========================
    // 4. Cập nhật appointment
    // ==========================
    public function update(AppointmentCreateUpdateRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->update($request->validated());

        return response()->json([
            'message' => 'Appointment updated successfully',
            'data'    => $appointment
        ]);
    }

    // ==========================
    // 5. Xóa appointment
    // ==========================
    public function destroy($id)
    {
        Appointment::destroy($id);

        return response()->json([
            'message' => 'Appointment deleted successfully'
        ], 200);
    }

    // ==========================
    // 6. Lịch sử khám bệnh của bệnh nhân (completed/done)
    // ==========================
    public function getPatientHistory(Request $request, $patientId)
    {
        $query = Appointment::with(['doctor.department'])
            ->where('patient_id', $patientId)
            ->whereIn('status', ['pending', 'completed', 'canceled']);


        // Filter theo khoảng thời gian
        if ($request->has('from')) {
            $query->whereDate('date', '>=', $request->from);
        }
        if ($request->has('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $appointments = $query->get()->map(function ($item) {
            return [
                'date' => $item->date,
                'time' => $item->time,
                'doctor' => $item->doctor->name,
                'department' => $item->doctor->department->name,
                'note' => $item->note,
            ];
        });

        return response()->json($appointments);
    }
}
