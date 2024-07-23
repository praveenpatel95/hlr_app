<?php

namespace App\Http\Requests\Patient;

use App\Exceptions\ValidationRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class PatientCreateUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'birthDate' => 'required|date',
            'group_id' => 'required|integer',
            'consultation_date' => 'required|date',
            'active' => 'nullable|bool',
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
