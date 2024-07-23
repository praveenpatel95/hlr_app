<?php

namespace App\Repository\FHIR;

use App\Exceptions\BadRequestException;
use App\Models\Schedules;
use App\Repository\Contracts\FHIR\ScheduleInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class ScheduleRepository implements ScheduleInterface
{
    /**
     * @param Schedules $practitioner
     */
    public function __construct(
        protected Schedules $schedules
    ){}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->schedules->all();
    }

    /**
     * @param int $id
     * @return Schedules
     * @throws BadRequestException
     */
    public function getById(int $id): Schedules
    {
        $schedule = $this->checkIfDataFound($id);
        return $schedule;
    }

    /**
     * @param array $practitioner
     * @return Schedules
     */
    public function create(array $schedules): Schedules
    {
        return $this->schedules->create($schedules);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function update(array $data, int $id): bool
    {
        $schedule = $this->checkIfDataFound($id);
        return $schedule->update($data);
    }

    /**
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function deleteById(int $id): bool
    {
        $schedules = $this->checkIfDataFound($id);
        return $schedules->delete();
    }

    /**
     * @param int $id
     * @return Schedules
     * @throws BadRequestException
     */
    private function checkIfDataFound(int $id): Schedules
    {
        $schedules = $this->schedules->find($id);
        if (!$schedules) {
            throw new BadRequestException("Schedules not found",
                Response::HTTP_BAD_REQUEST);
        }
        return $schedules;
    }
}
