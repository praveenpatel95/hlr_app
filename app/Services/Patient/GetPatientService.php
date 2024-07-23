<?php

namespace App\Services\Patient;

use App\Models\Patient;
use App\Repository\Contracts\FHIR\PatientInterface;
use Illuminate\Database\Eloquent\Collection;

class GetPatientService
{
    /**
     * @param PatientInterface $patientRepository
     */
    public function __construct(
        protected PatientInterface $patientRepository
    )
    {
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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->patientRepository->getAll();
    }

    /**
     * @return Patient
     */
    public function getById(): Patient
    {
        return $this->patientRepository->getById($this->id);
    }

    /**
     * @return bool
     */
    public function deleteById(): bool
    {
        return $this->patientRepository->deleteById($this->id);
    }
}
