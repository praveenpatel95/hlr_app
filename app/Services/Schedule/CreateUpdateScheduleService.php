<?php

namespace App\Services\Schedule;

use App\Exceptions\BadRequestException;
use App\Models\Schedules;
use App\Repository\Contracts\FHIR\ScheduleInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateUpdateScheduleService
{
    /**
     * @param ScheduleInterface $scheduleRepository
     */
    public function __construct(
        protected ScheduleInterface $scheduleRepository
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
     * @return Schedules|bool
     * @throws BadRequestException
     */
    public function process(): Schedules|bool
    {
        try {
            $request = $this->request->all();
            if(isset($this->id)){
                return $this->scheduleRepository->update($request, $this->id);
            }
            return $this->scheduleRepository->create($request);

        }catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
