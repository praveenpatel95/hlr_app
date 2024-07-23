<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;

Route::group(['prefix' => 'patient', 'middleware' => 'auth:api'], function () {
    Route::get('search', [PatientController::class, 'search']);
});
