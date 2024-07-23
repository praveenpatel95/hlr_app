<?php

namespace App\Services\Appointment;

use App\Exceptions\BadRequestException;
use App\Models\Appointment;
use App\Repository\Contracts\FHIR\AppointmentInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateUpdateAppointmentService
{
    /**
     * @param AppointmentInterface $appointmentRepository
     */
    public function __construct(
        protected AppointmentInterface $appointmentRepository
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
     * @return Appointment|bool
     * @throws BadRequestException
     */
    public function process(): Appointment|bool
    {
        try {
            $request = $this->request->all();
            if(isset($this->id)){
                return $this->appointmentRepository->update($request, $this->id);
            }
            return $this->appointmentRepository->create($request);

        }catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
