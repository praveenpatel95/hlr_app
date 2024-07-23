<?php

namespace App\Services\Practitioner;

use App\Models\Practitioner;
use App\Repository\Contracts\FHIR\PractitionerInterface;
use Illuminate\Database\Eloquent\Collection;

class GetPractitionerService
{
    /**
     * @param PractitionerInterface $practitionerRepository
     */
    public function __construct(
        protected PractitionerInterface $practitionerRepository


    )
    {}

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
        return $this->practitionerRepository->getAll();
    }

    /**
     * @return Practitioner
     */
    public function getById(): Practitioner
    {
        return $this->practitionerRepository->getById($this->id);
    }

    /**
     * @return bool
     */
    public function deleteById(): bool
    {
        return $this->practitionerRepository->deleteById($this->id);
    }
}
