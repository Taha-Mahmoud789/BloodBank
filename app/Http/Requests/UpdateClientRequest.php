<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        $clientId = $this->route('id'); // Get the client ID from the route

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $clientId,
            'password' => 'sometimes|string|min:6|confirmed',
            'phone' => 'required|unique:clients,phone,' . $clientId,
            'd_o_b' => ['required', 'date', 'before:today', 'after:1940-01-01'],
            'blood_type_id' => 'required|exists:blood_types,id',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
