<?php

namespace App\Services\Appointment;

use App\Models\Appointment;
use App\Repository\Contracts\FHIR\AppointmentInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAppointmentService
{
    /**
     * @param AppointmentInterface $appointmentRepository
     */
    public function __construct(
        protected AppointmentInterface $appointmentRepository
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
        return $this->appointmentRepository->getAll();
    }

    /**
     * @return Appointment
     */
    public function getById(): Appointment
    {
        return $this->appointmentRepository->getById($this->id);
    }

    /**
     * @return bool
     */
    public function deleteById(): bool
    {
        return $this->appointmentRepository->deleteById($this->id);
    }
}
