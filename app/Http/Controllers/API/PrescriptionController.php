<?php

namespace App\Http\Controllers\API;

use App\Models\Prescription;
use App\Http\Requests\PrescriptionCreateUpdateRequest;

class PrescriptionController
{
    public function index()
    {
        $search = request()->input('search');

        $query = Prescription::query()->with(['patient', 'doctor']);

        if ($search) {
            $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('doctor', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('diagnosis', 'like', '%' . $search . '%');
        }

        return response()->json($query->paginate(2));
    }

    public function store(PrescriptionCreateUpdateRequest $request)
    {
        $prescription = Prescription::query()->create($request->validated());

        return response()->json($prescription, 201);
    }

    public function show($id)
    {
        $prescription = Prescription::with(['patient', 'doctor'])
                                    ->findOrFail($id);

        return response()->json($prescription);
    }

    public function update(PrescriptionCreateUpdateRequest $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->update($request->validated());

        return response()->json([
            'message' => 'Prescription updated successfully',
            'data'    => $prescription
        ]);
    }

    public function destroy($id)
    {
        Prescription::destroy($id);

        return response()->json([
            'message' => 'Prescription deleted successfully'
        ], 204);
    }
}
