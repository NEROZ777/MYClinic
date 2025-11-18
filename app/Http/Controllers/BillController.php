<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function AddBill (Request $request) {
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'cost' => 'required|numeric|min:0'
        ]);

        if (!$validatedData) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => 'Patient id and cost required',
                'status_code' => 400
            ]);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $patient = Patient::where('id', $validatedData['patient_id'])->first();

                if (!$patient) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error Occurred',
                        'error' => 'Patient has not found',
                        'status_code' => 400
                    ]);
                }

                $bill = Bill::create([
                    'patient_id' => $validatedData['patient_id'],
                    'cost' => $validatedData['cost'],
                    'paid' => 0
                ]);

                if (!$bill) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error Occurred',
                        'data' => $bill,
                        'status_code' => 200
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Bill has added succefully',
                    'error' => 'Patient id and cost required',
                    'status_code' => 400
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => $e->getMessage(),
                'status_code' => 400
            ]);
        }
    }
}
