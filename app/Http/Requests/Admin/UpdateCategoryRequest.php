<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'parent_id' => [
                'nullable',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
                Rule::notIn([$this->route('category')->id]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'parent_id.exists' => 'Kategori induk yang dipilih tidak valid.',
            'parent_id.not_in' => 'Kategori tidak boleh menjadi induk dirinya sendiri.',
        ];
    }
}
