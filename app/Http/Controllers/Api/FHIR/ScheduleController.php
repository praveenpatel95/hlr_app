<?php

namespace App\Http\Controllers\Api\FHIR;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\ScheduleCreateUpdateRequest;
use App\Services\Schedule\CreateUpdateScheduleService;
use App\Services\Schedule\GetScheduleService;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    /**
     * @param GetScheduleService $getScheduleService
     * @param CreateUpdateScheduleService $createUpdateScheduleService
     */
    public function __construct(
        protected GetScheduleService          $getScheduleService,
        protected CreateUpdateScheduleService $createUpdateScheduleService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->getScheduleService->getAll());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success($this->getScheduleService
            ->setId($id)
            ->getById());
    }

    /**
     * @param ScheduleCreateUpdateRequest $request
     * @return JsonResponse
     */
    public function store(ScheduleCreateUpdateRequest $request): JsonResponse
    {
        return $this->success($this->createUpdateScheduleService->setRequest($request)
            ->process());
    }

    /**
     * @param ScheduleCreateUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function update(ScheduleCreateUpdateRequest $request, int $id): JsonResponse
    {
        return $this->success($this->createUpdateScheduleService
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
            $this->getScheduleService->setId($id)
                ->deleteById()
        );
    }
}
