<?php

namespace App\Services\Patient;

use App\Exceptions\BadRequestException;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Exception;

class SearchPatientService
{
    protected ?string $groupId;

    /**
     * @param string|null $groupId
     * @return void
     */
    public function setGroupId(?string $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    protected ?string $dateRange;

    /**
     * @param string|null $dateRange
     * @return void
     */
    public function setDateRange(?string $dateRange): self
    {
        $this->dateRange = $dateRange;
        return $this;
    }

    /**
     * @param Patient $patient
     */
    public function __construct(
        protected Patient $patient
    )
    {}

    /**
     * @return Collection|BadRequestException
     * @throws BadRequestException
     */
    public function process() :Collection|BadRequestException
    {
        try {
            return $this->patient
                ->getFilterPatients($this->groupId, $this->dateRange);
        } catch (Exception $exception) {
            throw new BadRequestException($exception->getMessage(),
                Response::HTTP_BAD_REQUEST);
        }
    }
}
