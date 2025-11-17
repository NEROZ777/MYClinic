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
                'message' => 'BILL HAS NOT ADDED, ID AND COST REQUIRED'
            ], 400);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $patient = Patient::where('id', $validatedData['patient_id'])->first();

                if (!$patient) {
                    return response()->json([
                        'message' => 'BILL HAS NOT ADDED, PATIENT HAS NOT FOUND'
                    ]);
                }

                $bill = Bill::create([
                    'patient_id' => $validatedData['patient_id'],
                    'cost' => $validatedData['cost'],
                    'paid' => 0
                ]);

                if (!$bill) {
                    return response()->json([
                        'message' => 'BILL HAS NOT ADDED'
                    ], 400);
                }

                return response()->json([
                    'bill' => $bill
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'BILL HAS NOT ADDED',
                'error' => $e->getMessage()
            ]);
        }
    }
}
