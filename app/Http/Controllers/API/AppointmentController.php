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

        $data = $query->paginate(10);

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

        return response()->json([
            'message' => 'Lịch sử khám bệnh của bệnh nhân',
            'data' => $appointments
        ]);
    }

    // =======================================================
    // 7. Lấy giờ trống của bác sĩ theo ngày
    // =======================================================
    public function getFreeSlots(Request $request, $doctorId)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['message' => 'Thiếu tham số date'], 400);
        }

        // Khung giờ làm việc cố định (ví dụ)
        $workHours = [
            '08:00', '09:00', '10:00', '11:00',
            '13:00', '14:00', '15:00', '16:00'
        ];

        // Lấy các giờ đã được đặt
        $booked = Appointment::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->whereIn('status', ['pending', 'accepted'])
            ->pluck('time')
            ->toArray();

        // Loại giờ trùng
        $freeSlots = array_values(array_diff($workHours, $booked));

        return response()->json([
            'doctor_id' => $doctorId,
            'date' => $date,
            'free_slots' => $freeSlots
        ]);
    }


    // =======================================================
    // 8. Đặt lịch hẹn (check trùng)
    // =======================================================
    public function book(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        // Check trùng
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Bác sĩ đã có lịch vào giờ này'
            ], 400);
        }

        // Tạo lịch
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
            'note' => $request->note ?? null
        ]);

        return response()->json([
            'message' => 'Đặt lịch thành công, chờ bác sĩ duyệt',
            'data' => $appointment
        ]);
    }


    // =======================================================
    // 9. Bác sĩ duyệt lịch (ACCEPT)
    // =======================================================
    public function accept($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Không tìm thấy lịch'], 404);
        }

        $appointment->status = 'accepted';
        $appointment->save();

        return response()->json([
            'message' => 'Đã duyệt lịch hẹn',
            'data' => $appointment
        ]);
    }


    // =======================================================
    // 10. Bác sĩ từ chối lịch (REJECT)
    // =======================================================
    public function reject($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Không tìm thấy lịch'], 404);
        }

        $appointment->status = 'rejected';
        $appointment->save();

        return response()->json([
            'message' => 'Đã từ chối lịch hẹn',
            'data' => $appointment
        ]);
    }
}
