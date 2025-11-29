<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\DoctorCreateUpdateRequest;
use App\Models\Doctor;

class DoctorController
{
    public function index()
    {
        $search = request()->input('search');

        $query = Doctor::query();
        if ($search != null) {
            $query->where('code', $search)
                  ->orWhere('name', 'like', '%' . $search . '%');
        }
        $query->with('department');

        $data = $query->paginate(2);

        return response()->json($data);
    }

    public function store(DoctorCreateUpdateRequest $request)
    {
        $doctor = Doctor::query()->create($request->validated());

        return response()->json($doctor, 201);
    }

    public function show($id)
    {
        $doctor = Doctor::with('department')->findOrFail($id);

        return response()->json($doctor);
    }

    public function update(DoctorCreateUpdateRequest $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->validated());

        return response()->json([
            'message' => 'Doctor updated successfully',
            'data'    => $doctor
        ]);
    }

    public function destroy($id)
    {
        Doctor::destroy($id);

        return response()->json([
            'message' => 'Doctor deleted successfully'
        ], 204);
    }
}
