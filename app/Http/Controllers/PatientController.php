<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class PatientController extends Controller
{
    public function AddPatient (Request $request) {
        $validatedData = $request->validate(
            [
                'first_name' => 'required|min:0|max:255',
                'mid_name' => 'required|min:0|max:255',
                'last_name' => 'required|min:0|max:255',
                'born_date' => 'required|date'
            ]
        );

        if (!$validatedData) {
            return response()->json([
                'message' => 'MISSING DATA'
            ], 400);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $fullName = $validatedData['first_name'] . " " . $validatedData['mid_name'] . " " . $validatedData['last_name'];
                $name = Patient::where('full_name', $fullName)->first();
                if ($name) {
                    return response()->json([
                        'message' => 'THIS USER IS ALREADY EXIST'
                    ], 400);
                }
                $user = Patient::create([
                    'full_name' => $fullName,
                    'born_date' => $validatedData['born_date']
                ]);
                if (!$user) {
                    return response()->json([
                        'message' => 'USER HAS NOT CREATED'
                    ], 400);
                }
                return response()->json([
                    'message' => 'USER HAS BEEN CREATED',
                    'user' => [
                        'id' => $user->id,
                        'full_name' => $user->full_name,
                        'born_date' => $user->born_date
                    ]
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'USER HAS NOT CREATED',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function DeletePatient (Request $request) {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        if (!$validatedData) {
            return response()->json([
                'message' => 'PATIENT HAS NOT DELETED, ID REQUIRED'
            ], 400);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $patient = Patient::where('id', $validatedData['id'])->first();

                if (!$patient) {
                    return response()->json([
                        'message' => 'PATIENT HAS NOT DELETED, PATIENT HAS NOT FOUND'
                    ], 400);
                }

                $patient->delete();

                $patient = Patient::where('id', $validatedData['id'])->first();

                if ($patient) {
                    return response()->json([
                        'message' => 'PATIENT HAS NOT DELETED, SOMETHING WRONG'
                    ], 400);
                }

                return response()->json([
                    'message' => 'PATIENT WITH ID ' . $validatedData['id'] . ' HAS BEEN DELETED'
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'USER HAS NOT CREATED',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function EditPatient (Request $request) {
        $validatedData = $request->validate([
            'id' => 'required',
            'full_name' => 'min:0|max:255',
            'born_date' => 'date'
        ]);

        if (!$validatedData) {
            return response()->json([
                'message' => 'PATIENT HAS NOT FOUND, ID REQUIRED, OR SOME VARIABLES MISSED'
            ], 400);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $patient = Patient::where('id', $validatedData['id'])->first();

                if (!$patient) {
                    return response()->json([
                        'message' => 'PATIENT HAS NOT FOUND'
                    ], 400);
                }

                $patient->full_name = $validatedData['full_name'];
                $patient->date = $validatedData['date'];

                $patient->save();

                return response()->json([
                    'patient' => $patient
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'PATIENT HAS NOT EDITED',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function GetPatients () {
        try {
            $response = DB::transaction(function () {
                $patients = Patient::all();

                if ($patients->isEmpty()) {
                    return response()->json([
                        'message' => 'THERE ARE NO PATIENTS FOUND'
                    ], 400);
                }

                return response()->json([
                    'patients' => $patients
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'SOMETHING HAPPENED',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
