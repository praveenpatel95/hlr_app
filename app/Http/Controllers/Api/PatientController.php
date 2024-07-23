<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Patient\SearchPatientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * @param SearchPatientService $searchPatientService
     */
    public function __construct(
        protected SearchPatientService $searchPatientService
    )
    {}

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function search(Request $request): JsonResponse
    {
        $response =  $this->searchPatientService
            ->setGroupId($request->group)
            ->setDateRange($request->date_range)
            ->process();
        return $this->success($response);
    }
}
