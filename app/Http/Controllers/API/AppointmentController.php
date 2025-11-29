<?php

namespace App\Http\Controllers\API;

use App\Models\Appointment;
use App\Http\Requests\AppointmentCreateUpdateRequest;

class AppointmentController
{
    public function index()
    {
        $search = request()->input('search');

        $query = Appointment::query()
                  ->with(['patient', 'doctor']);

        if ($search != null) {
            $query->whereHas('patient', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('doctor', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhere('date', $search);
        }

        $data = $query->paginate(2);

        return response()->json($data);
    }

    public function store(AppointmentCreateUpdateRequest $request)
    {
        $appointment = Appointment::query()->create($request->validated());

        return response()->json($appointment, 201);
    }

    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);

        return response()->json($appointment);
    }

    public function update(AppointmentCreateUpdateRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->update($request->validated());

        return response()->json([
            'message' => 'Appointment updated successfully',
            'data'    => $appointment
        ]);
    }

    public function destroy($id)
    {
        Appointment::destroy($id);

        return response()->json([
            'message' => 'Appointment deleted successfully'
        ], 204);
    }
}
