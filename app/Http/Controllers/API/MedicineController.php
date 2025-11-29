<?php

namespace App\Http\Controllers\API;

use App\Models\Medicine;
use App\Http\Requests\MedicineCreateUpdateRequest;

class MedicineController
{
    public function index()
    {
        $search = request()->input('search');

        $query = Medicine::query();

        if ($search != null) {
            $query->where('code', $search)
                  ->orWhere('name', 'like', '%' . $search . '%');
        }

        $data = $query->paginate(2);

        return response()->json($data);
    }

    public function store(MedicineCreateUpdateRequest $request)
    {
        $medicine = Medicine::query()->create($request->validated());

        return response()->json($medicine, 201);
    }

    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);

        return response()->json($medicine);
    }

    public function update(MedicineCreateUpdateRequest $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $medicine->update($request->validated());

        return response()->json([
            'message' => 'Medicine updated successfully',
            'data'    => $medicine
        ]);
    }

    public function destroy($id)
    {
        Medicine::destroy($id);

        return response()->json([
            'message' => 'Medicine deleted successfully'
        ], 204);
    }
}
