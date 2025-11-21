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
            ], 400);
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
                    ], 400);
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
                    ], 200);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Bill has been added succefully',
                    'data' => $bill,
                    'status_code' => 200
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => $e->getMessage(),
                'status_code' => 400
            ], 400);
        }
    }

    public function EditBill (Request $request) {
        $validatedData = $request->validate([
            'bill_id' => 'required',
            'cost' => 'required|numeric|min:0'
        ]);

        if (!$validatedData) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => 'Id & Cost fields required',
                'status_code' => 400
            ], 400);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $bill = Bill::where('id', $validatedData['bill_id'])->first();

                if (!$bill) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error Occurred',
                        'error' => 'Bill has not found',
                        'status_code' => 400
                    ], 400);
                }

                $oldBill = $bill;

                $bill->cost = $validatedData['cost'];

                $bill->save();

                if (!($bill->cost == $validatedData['cost'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error Occurred',
                        'error' => 'the modulation has not saved',
                        'status_code' => 400
                    ], 400);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Bill data has been updated',
                    'data' => [
                        'old_bill' => $oldBill,
                        'updated_bill' => $bill
                    ],
                    'status_code' => 200
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => $e->getMessage(),
                'status_code' => 400
            ], 400);
        }
    }

    public function SetBillPaid (Request $request) {
        $validatedData = $request->validate([
            'bill_id' => 'required'
        ]);

        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => 'Bill Id required',
                'status_code' => 400
            ], 400);
        }

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $bill = Bill::where('id', $validatedData['bill_id'])->first();

                if (!$bill) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error Occurred',
                        'error' => 'Bill has not found',
                        'status_code' => 400
                    ], 400);
                }

                $bill->paid = true;

                $bill->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Bill has set to paid',
                    'data' => $bill,
                    'status_code' => 200
                ], 200);
            });

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error Occurred',
                'error' => $e->getMessage(),
                'status_code' => 400
            ], 400);
        }
    }
}
