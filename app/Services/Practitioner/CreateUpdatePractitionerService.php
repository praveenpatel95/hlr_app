<?php

namespace App\Services\Practitioner;

use App\Exceptions\BadRequestException;
use App\Models\Practitioner;
use App\Repository\Contracts\FHIR\PractitionerInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateUpdatePractitionerService
{
    /**
     * @param PractitionerInterface $practitionerRepository
     */
    public function __construct(
       protected PractitionerInterface $practitionerRepository
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
     * @return Practitioner|bool
     * @throws BadRequestException
     */
    public function process(): Practitioner|bool
    {
        try {
            $request = $this->request->all();
            if(isset($this->id)){
                return $this->practitionerRepository->update($request, $this->id);
            }
            return $this->practitionerRepository->create($request);

        }catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
