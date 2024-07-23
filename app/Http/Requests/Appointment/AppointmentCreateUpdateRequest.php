<?php

namespace App\Http\Requests\Appointment;

use App\Exceptions\ValidationRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class AppointmentCreateUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'practitioner_id' => 'required|exists:practitioners,id',
            'schedule_id' => 'required|exists:schedules,id',
            'status' => 'nullable|bool',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     * @throws ValidationRequestException
     */
    public function failedValidation(Validator $validator)
    {
        throw new ValidationRequestException($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
