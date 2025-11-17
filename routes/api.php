<?php

use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//_________/// PATIENT APIS ///________//
Route::post('/patient/add_patient', [PatientController::class, 'AddPatient']);
Route::post('/patient/delete_patient', [PatientController::class, 'DeletePatient']);
Route::post('/patient/edit_patient', [PatientController::class, 'EditPatient']);
Route::get('/patient/get_patients', [PatientController::class, 'GetPatients']);
//_____________________________________//
