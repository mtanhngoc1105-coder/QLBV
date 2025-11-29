<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorCreateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:100',
            'code'          => 'required|string|max:10|unique:doctors,code,' . $this->route('doctor'),
            'specialty'     => 'nullable|string|max:100',
            'department_id' => 'required|exists:departments,id',
            'phone'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
        ];
    }
}
