<?php

namespace App\Repository\FHIR;

use App\Exceptions\BadRequestException;
use App\Models\Practitioner;
use App\Repository\Contracts\FHIR\PractitionerInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class PractitionerRepository implements PractitionerInterface
{
    /**
     * @param Practitioner $practitioner
     */
    public function __construct(
        protected Practitioner $practitioner
    ){}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->practitioner->all();
    }

    /**
     * @param int $id
     * @return Practitioner
     * @throws BadRequestException
     */
    public function getById(int $id): Practitioner
    {
        $practitioner = $this->checkIfDataFound($id);
        return $practitioner;
    }

    /**
     * @param array $practitioner
     * @return Practitioner
     */
    public function create(array $practitioner): Practitioner
    {
        return $this->practitioner->create($practitioner);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function update(array $data, int $id): bool
    {
        $practitioner = $this->checkIfDataFound($id);
        return $practitioner->update($data);
    }

    /**
     * @param int $id
     * @return bool
     * @throws BadRequestException
     */
    public function deleteById(int $id): bool
    {
        $practitioner = $this->checkIfDataFound($id);
        return $practitioner->delete();
    }

    /**
     * @param int $id
     * @return Practitioner
     * @throws BadRequestException
     */
    private function checkIfDataFound(int $id): Practitioner
    {
        $practitioner = $this->practitioner->find($id);
        if (!$practitioner) {
            throw new BadRequestException("Practitioner not found",
                Response::HTTP_BAD_REQUEST);
        }
        return $practitioner;
    }
}
