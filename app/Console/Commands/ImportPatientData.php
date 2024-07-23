<?php

namespace App\Console\Commands;

use App\Services\Patient\ImportPatientDataService;
use Illuminate\Console\Command;

class ImportPatientData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-patient-data {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import patients data from csv';

    public function __construct(
        protected ImportPatientDataService $importPatientDataService
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        try {
            $this->importPatientDataService->setFileName($filename)
                ->process();
            $this->info('File has been imported successfully.');
        } catch (Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
