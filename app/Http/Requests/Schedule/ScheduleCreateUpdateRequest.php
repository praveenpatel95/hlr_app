<?php

namespace App\Http\Requests\Schedule;

use App\Exceptions\ValidationRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class ScheduleCreateUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'practitioner_id' => 'required|exists:practitioners,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'is_available' => 'nullable|bool',
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
