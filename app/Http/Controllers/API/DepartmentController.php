<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentCreateUpdateRequest;
use App\Models\Department;

class DepartmentController
{
    public function index()
    {
        $search = request()->input('search');

        $query = Department::query();
        if ($search != null) {
            $query->where('code', $search)
                ->orWhere('name', 'like', '%' . $search . '%');
        }
        $query->with('doctors');
        $data = $query->paginate(2);
        return response()->json($data);
    }

    public function store(DepartmentCreateUpdateRequest $request)
    {
        $data = ($request->validated());
        $department = Department::query()->create(attributes: $data);
        return response()->json($department, 201);
    }

    public function show($id)
    {
        $dept = Department::findOrFail($id);

        return response()->json($dept);
    }

    public function update(DepartmentCreateUpdateRequest $request, $id)
    {
        $dept = Department::findOrFail($id);

        $dept->update($request->validated());

        return response()->json([
            'message' => 'Department updated successfully',
            'data' => $dept
        ]);
    }

    public function destroy($id)
    {
        Department::destroy($id);

        return response()->json([
            'message' => 'Department deleted successfully'
        ], 204);
    }
}
