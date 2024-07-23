<?php

namespace App\Services\Patient;

use App\Models\Group;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class ImportPatientDataService
{
    protected string $fileName;

    protected $faker;

    public function __construct(
        protected Patient $patient
    )
    {
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }


    public function process(): void
    {
        DB::beginTransaction();

        $filePath = storage_path($this->fileName);
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist: $filePath");
        }

        try {
            $fh = fopen($filePath, 'r');
            if ($fh === false) {
                throw new Exception("Failed to open file: $filePath");
            }
            $patients = [];
            $isHeader = true;

            while ($row = fgetcsv($fh)) {
                if ($isHeader) {
                    $isHeader = false;
                    continue;
                }

                [$firstName, $lastName, $dob, $group] = $row;
                $groupId = Group::where('group_value', $group)->first()->id;
                $patients[] = [
                    'name' => $firstName ." ".$lastName,
                    'birthDate' => date('Y-m-d H:i', strtotime($dob)),
                    'group_id' => $groupId,
                    'consultation_date' => fake()
                        ->dateTimeBetween('-1 month', '+1 month'),
                ];
            }
            if (!empty($patients)) {
                $this->patient->insert($patients);
            }
            fclose($fh);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            if (isset($fh) && is_resource($fh)) {
                fclose($fh);
            }
            throw $exception;
        }
    }

}
