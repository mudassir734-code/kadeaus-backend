<?php

namespace App\Http\Requests\Vaccination;

use Illuminate\Foundation\Http\FormRequest;

class VaccinationTrackingRequest extends FormRequest
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
            'user_id'   => ['required', 'integer', 'exists:users,id'],
            'name'      => ['required', 'string'],
            'type'      => ['required', 'in:Childhood,Adult,Travel,Booster,Unknown'],
            'primary_dose_date' => ['required', 'date'],
            'status'    => ['required', 'in:Completed,Missed'],
            'hospital'  => ['required', 'string'],
        ];
    }
}
