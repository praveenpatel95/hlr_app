<?php

namespace App\Repository\FHIR;

use App\Exceptions\BadRequestException;
use App\Models\Patient;
use App\Repository\Contracts\FHIR\PatientInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class PatientRepository implements PatientInterface
{
    /**
     * @param Patient $patient
     */
    public function __construct(
        protected Patient $patient
    ){}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->patient->all();
    }

    /**
     * @param int $id
     * @return Patient
     * @throws BadRequestException
     */
    public function getById(int $id){
        $patient = $this->checkIfDataFound($id);
        return $patient;
    }

    /**
     * @param array $patient
     * @return Patient
     */
    public function create(array $patient): Patient
    {
        return $this->patient->create($patient);
    }

    /**
     * @param array $patientData
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function update(array $patientData, int $id): bool
    {
        $patient = $this->checkIfDataFound($id);
        return $patient->update($patientData);
    }

    /**
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function deleteById(int $id): bool
    {
        $patient = $this->checkIfDataFound($id);
        return $patient->delete();
    }

    /**
     * @param int $id
     * @return Patient
     * @throws BadRequestException
     */
    private function checkIfDataFound(int $id): Patient
    {
        $patient = $this->patient->find($id);
        if (!$patient) {
            throw new BadRequestException("Patient not found",
                Response::HTTP_BAD_REQUEST);
        }
        return $patient;
    }
}
