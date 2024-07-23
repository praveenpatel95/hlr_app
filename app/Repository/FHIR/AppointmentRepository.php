<?php

namespace App\Repository\FHIR;

use App\Exceptions\BadRequestException;
use App\Models\Appointment;
use App\Repository\Contracts\FHIR\AppointmentInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class AppointmentRepository implements AppointmentInterface
{
    /**
     * @param Appointment $appointment
     */
    public function __construct(
        protected Appointment $appointment
    ){}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->appointment->all();
    }

    /**
     * @param int $id
     * @return Appointment
     * @throws BadRequestException
     */
    public function getById(int $id): Appointment
    {
        $appointment = $this->checkIfDataFound($id);
        return $appointment;
    }

    /**
     * @param array $schedules
     * @return Appointment
     */
    public function create(array $schedules): Appointment
    {
        return $this->appointment->create($schedules);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function update(array $data, int $id): bool
    {
        $appointment = $this->checkIfDataFound($id);
        return $appointment->update($data);
    }

    /**
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function deleteById(int $id): bool
    {
        $appointment = $this->checkIfDataFound($id);
        return $appointment->delete();
    }

    /**
     * @param int $id
     * @return Appointment
     * @throws BadRequestException
     */
    private function checkIfDataFound(int $id): Appointment
    {
        $appointment = $this->appointment->find($id);
        if (!$appointment) {
            throw new BadRequestException("Appointment not found",
                Response::HTTP_BAD_REQUEST);
        }
        return $appointment;
    }
}
