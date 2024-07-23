<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FHIR\PatientController;
use App\Http\Controllers\Api\FHIR\PractitionerController;
use App\Http\Controllers\Api\FHIR\ScheduleController;
use App\Http\Controllers\Api\FHIR\AppointmentController;

Route::group(['prefix' => 'remcare/hl7/fhir', 'middleware' => 'auth:api'], function () {
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('practitioner', PractitionerController::class);
    Route::apiResource('schedule', ScheduleController::class);
    Route::apiResource('appointments', AppointmentController::class);
});
