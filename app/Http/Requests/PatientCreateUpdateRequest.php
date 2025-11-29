<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientCreateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // dd(1);
        return [
            'name'    => 'required|string|max:100',
            'dob'     => 'nullable|date',
            'gender'  => 'nullable|in:male,female,other',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
        ];
    }
}
