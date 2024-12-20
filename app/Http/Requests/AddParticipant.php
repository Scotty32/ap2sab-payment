<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddParticipant extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'profession' => 'nullable|string',
            'promotion' => 'nullable|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'prénom',
            'last_name' => 'nom',
            'phone_number' => 'numero de téléphone',
            'profession' => 'nullable|string',
            'promotion' => 'nullable|string',
            'city' => 'ville',
            'country' => 'pays',
        ];
    }
}
