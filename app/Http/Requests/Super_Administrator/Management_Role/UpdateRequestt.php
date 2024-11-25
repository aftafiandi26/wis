<?php

namespace App\Http\Requests\Super_Administrator\Management_Role;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequestt extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ["required"],
            'name'     => ["required"],
            'email'    => ["required "],
            "department"    => ["required"],
        ];
    }

    public function messages(): array
    {
        return [
            // 'username.required' => 'Username is required',
            // 'username.unique' => 'Sorry, email sudah ada',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();  // Mengambil semua pesan error dalam bentuk array

        // Menggabungkan semua pesan error menjadi satu string untuk session flash
        $errorMessage = implode(', ', $errors);

        throw new HttpResponseException(
            redirect()->route('management-role-access.index')
                ->withErrors($validator)
                ->with('dangerRoleAccess', $errorMessage)
                ->withInput()             // Mengembalikan input yang telah diisi
        );
    }

}
