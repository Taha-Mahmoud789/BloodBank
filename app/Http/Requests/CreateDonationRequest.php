<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDonationRequest extends FormRequest
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
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'hospital_name' => 'required|string|max:255',
            'patient_age' => 'required|integer|min:0|max:150',
            'bags' => 'required|integer|min:1',
            'num' => 'required|string|max:255',
            'hospital_address' => 'required|string|max:255',
            'details' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'client_id' => 'required|exists:clients,id',
            'blood_type_id' => 'required|exists:blood_types,id',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
