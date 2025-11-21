<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//_________/// PATIENT APIS ///________//
Route::post('/patient/add_patient', [PatientController::class, 'AddPatient']);
Route::post('/patient/delete_patient', [PatientController::class, 'DeletePatient']);
Route::post('/patient/edit_patient', [PatientController::class, 'EditPatient']);
Route::get('/patient/get_patient', [PatientController::class, 'GetPatient']);
Route::get('/patient/get_patients', [PatientController::class, 'GetPatients']);
Route::get('patient/search_patient', [PatientController::class, 'SearchPatient']);
//_____________________________________//


//__________/// BILL APIS ///__________//
Route::post('bill/add_bill', [BillController::class, 'AddBill']);
Route::post('bill/edit_bill', [BillController::class, 'EditBill']);
Route::post('bill/set_bill_paid', [BillController::class, 'SetBillPaid']);
//_____________________________________//
