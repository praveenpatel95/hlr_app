<?php

namespace App\Services\Patient;

use App\Exceptions\BadRequestException;
use App\Models\Patient;
use App\Repository\Contracts\FHIR\PatientInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateUpdatePatientService
{
    /**
     * @param PatientInterface $patientRepository
     */
    public function __construct(
       protected PatientInterface $patientRepository
    )
    {}

    protected Request $request;

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    protected int $id;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Patient|bool
     * @throws BadRequestException
     */
    public function process(): Patient|bool
    {
        try {
            $request = $this->request->all();
            if(isset($this->id)){
                return $this->patientRepository->update($request, $this->id);
            }
            return $this->patientRepository->create($request);

        }catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
