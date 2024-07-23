<?php

namespace App\Http\Controllers\Api\FHIR;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\PatientCreateUpdateRequest;
use App\Services\Patient\CreateUpdatePatientService;
use App\Services\Patient\CreateUpdatePractitionerService;
use App\Services\Patient\GetPatientService;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{
    /**
     * @param GetPatientService $getPatientService
     * @param CreateUpdatePractitionerService $createPatientService
     */
    public function __construct(
        protected GetPatientService          $getPatientService,
        protected CreateUpdatePatientService $createPatientService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->getPatientService->getAll());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->success($this->getPatientService
            ->setId($id)
            ->getById());
    }

    /**
     * @param PatientCreateUpdateRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function store(PatientCreateUpdateRequest $request): JsonResponse
    {
        return $this->success($this->createPatientService->setRequest($request)
            ->process());
    }

    /**
     * @param PatientCreateUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function update(PatientCreateUpdateRequest $request, int $id): JsonResponse
    {
        return $this->success($this->createPatientService
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
            $this->getPatientService->setId($id)
                ->deleteById()
        );
    }
}
