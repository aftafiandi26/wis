<?php

namespace App\Http\Requests\HRD\Employes;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'nik'           => ["required", "min:5", 'unique:employes,nik', 'numeric'],
            'department'    => ["required"],
            'joinDate'      => ["required"],
            'endDate'       => ["required"],
            'firstName'         => ["required", 'min:3', "string"],
            'lasName'           => ["string"],
            'gender'            => ["required"],
            'department'        => ["required"],
            'position'          => ["required"],
            'empStat'           => ["required"],
            'joinDate'          => ["required", "date"],
            'endDate'           => ["required", "date"],
            'bod'               => ["required", "date"],
            'pob'               => ["required", "min:5", "string"],
            'province'          => ["required", "min:3", "string"],
            'maiden'            => ["required", "min:3", "string"],
            'ktp'               => ["required", "numeric", "min:12"],
            'address'           => ["required", "min:5"],
            'area'              => ["required", "min:5"],
            'city'              => ["required", "min:5"],
            'education'         => ["required", "min:5"],
            'institution'       => ["required", "min:3"],
            'marital'           => ["required"],
            'npwp'              => ["required"],
            'kk'                => ["required", "numeric", 'min:10'],
            'nationally'        => ["required", "min:5", "string"],
            'religion'          => ["required"],
            'ketenagakerjaan'   => ["numeric", "min:6"],
            'kesehatan'         => ["numeric", "min:6"],
            'file'              => ["required", "mimes:png,jpg,jpeg"],
            'project'           => ["required", "array", "min:1"],
            'project.*'         => ["required", "integer", "exists:projects,id"]
        ];
    }

    public function messages()
    {
        return [
            'nik.unique'        => 'These NIK already taken',
        ];
    }
}
