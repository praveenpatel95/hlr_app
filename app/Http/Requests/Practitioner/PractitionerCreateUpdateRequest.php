<?php

namespace App\Http\Requests\Practitioner;

use App\Exceptions\ValidationRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class PractitionerCreateUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'birthDate' => 'required|date',
            'gender' => 'required|in:M,F,O',
            'address' => 'required|max:255',
            'telecom' => 'required',
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
