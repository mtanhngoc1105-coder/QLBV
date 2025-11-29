<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use App\Http\Requests\PatientCreateUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PatientController
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $search = request()->input('search');

        $query = Patient::query();
        if ($search != null) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', $search)
                  ->orWhere('email', $search);
        }

        $data = $query->paginate(2);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param PatientCreateUpdateRequest $request
     * @return JsonResponse
     */
    public function store(PatientCreateUpdateRequest $request): JsonResponse
    {
        $patient = Patient::query()->create($request->validated());

        return response()->json($patient, 201);
    }

    public function show(Patient $patient): JsonResponse
    {
        return response()->json($patient);
    }

    public function update(PatientCreateUpdateRequest $request, Patient $patient): JsonResponse
    {
        $patient->update($request->validated());

        return response()->json([
            'message' => 'Patient updated successfully',
            'data'    => $patient
        ]);
    }

    public function destroy($id)
    {
        Patient::destroy($id);

        return response()->json([
            'message' => 'Patient deleted successfully'
        ], 204);
    }
}
