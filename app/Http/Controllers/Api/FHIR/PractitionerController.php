<?php

namespace App\Http\Controllers\Api\FHIR;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practitioner\PractitionerCreateUpdateRequest;
use App\Services\Practitioner\CreateUpdatePractitionerService;
use App\Services\Practitioner\GetPractitionerService;
use Illuminate\Http\JsonResponse;

class PractitionerController extends Controller
{
    /**
     * @param GetScheduleService $getPractitionerService
     * @param CreateUpdatePractitionerService $createUpdatePractitionerService
     */
    public function __construct(
        protected GetPractitionerService              $getPractitionerService,
        protected CreateUpdatePractitionerService $createUpdatePractitionerService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->getPractitionerService->getAll());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success($this->getPractitionerService
            ->setId($id)
            ->getById());
    }

    /**
     * @param PractitionerCreateUpdateRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function store(PractitionerCreateUpdateRequest $request): JsonResponse
    {
        return $this->success(
            $this->createUpdatePractitionerService->setRequest($request)
            ->process());
    }

    /**
     * @param PractitionerCreateUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function update(PractitionerCreateUpdateRequest $request, int $id): JsonResponse
    {
        return $this->success($this->createUpdatePractitionerService
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
            $this->getPractitionerService->setId($id)
                ->deleteById()
        );
    }
}
