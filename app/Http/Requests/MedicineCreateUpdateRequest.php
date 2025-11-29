<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineCreateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:150',
            'code'        => 'required|string|max:50|unique:medicines,code,' . $this->route('medicine'),
            'category'    => 'nullable|string|max:100',
            'unit'        => 'nullable|string|max:50',
            'price'       => 'nullable|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'description' => 'nullable|string|max:255',
        ];
    }
}
