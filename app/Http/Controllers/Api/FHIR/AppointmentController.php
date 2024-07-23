<?php

namespace App\Http\Controllers\Api\FHIR;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentCreateUpdateRequest;
use App\Services\Appointment\CreateUpdateAppointmentService;
use App\Services\Appointment\GetAppointmentService;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    /**
     * @param GetAppointmentService $getAppointmentService
     * @param CreateUpdateAppointmentService $createUpdateAppointmentService
     */
    public function __construct(
        protected GetAppointmentService          $getAppointmentService,
        protected CreateUpdateAppointmentService $createUpdateAppointmentService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->getAppointmentService->getAll());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success($this->getAppointmentService
            ->setId($id)
            ->getById());
    }

    /**
     * @param AppointmentCreateUpdateRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function store(AppointmentCreateUpdateRequest $request): JsonResponse
    {
        return $this->success($this->createUpdateAppointmentService->setRequest($request)
            ->process());
    }

    /**
     * @param AppointmentCreateUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function update(AppointmentCreateUpdateRequest $request, int $id): JsonResponse
    {
        return $this->success($this->createUpdateAppointmentService
            ->setRequest($request)
            ->setId($id)
            ->process());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->success(
            $this->getAppointmentService->setId($id)
                ->deleteById()
        );
    }
}
