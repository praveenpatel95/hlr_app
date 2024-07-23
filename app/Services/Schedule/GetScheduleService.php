<?php

namespace App\Services\Schedule;

use App\Models\Schedules;
use App\Repository\Contracts\FHIR\ScheduleInterface;
use Illuminate\Database\Eloquent\Collection;

class GetScheduleService
{
    /**
     * @param ScheduleInterface $scheduleRepository
     */
    public function __construct(
        protected ScheduleInterface $scheduleRepository
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
        return $this->scheduleRepository->getAll();
    }

    /**
     * @return Schedules
     */
    public function getById(): Schedules
    {
        return $this->scheduleRepository->getById($this->id);
    }

    /**
     * @return bool
     */
    public function deleteById(): bool
    {
        return $this->scheduleRepository->deleteById($this->id);
    }
}
