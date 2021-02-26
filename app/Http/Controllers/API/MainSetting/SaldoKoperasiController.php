<?php

namespace App\Http\Controllers\Api\MainSetting;

use App\Http\Controllers\API\Transaction\TraitTransaction;
use App\Http\Controllers\Controller;
use App\Models\MainSetting;
use App\Models\User;
use Illuminate\Http\Request;

class SaldoKoperasiController extends Controller
{
    use TraitTransaction;
    public function add_saldo(Request $request)
    {
        $user_id = auth()->user()->id;
        $this->validate($request, [
            'besaran' => ['required', 'numeric']
        ]);
        
        $user = User::find($user_id);
        if($user_id) {
            // Transaction
            $transaction_data = [
                'user_id' => $user->id,
                'title' => 'add saldo from admin',
                'type' => 'saldo_koperasi',
                'approved_date' => now()
            ];

            // Sub Transaction
            $sub_transaction_data = [
                [
                    'type' => 'saldo_koperasi',
                    'besaran' => $request->besaran
                ]
            ];
            $this->transaction($transaction_data, $sub_transaction_data);
            $saldo = MainSetting::where('name_setting', 'saldo')->first();
            $total_saldo = $saldo->value + $request->besaran;
            $saldo->update([ 'value' => $total_saldo ]);
            return response()->json([
                'data' => [
                    'saldo' => $saldo->value
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
