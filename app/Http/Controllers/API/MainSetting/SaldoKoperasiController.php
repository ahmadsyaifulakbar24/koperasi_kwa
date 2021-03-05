<?php

namespace App\Http\Controllers\API\MainSetting;

use App\Http\Controllers\API\Transaction\TraitTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\PinjamanResource;
use App\Models\MainSetting;
use App\Models\Pinjaman;
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

    public function min_saldo(Request $request)
    {
        $this->validate($request, [
            'transaction_type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'total' => ['required', 'numeric'],
        ]);

        $user_id = auth()->user()->id;
        $pinjaman = Pinjaman::create([
            'user_id' => $user_id,
            'transaction_type' => $request->transaction_type,
            'description' => $request->description,
            'besar_pinjaman' => $request->total,
            'approved_date' => \Carbon\Carbon::now(),
        ]);
        
        $saldo_koperasi = MainSetting::where('name_setting', 'saldo')->first();
        $saldo_koperasi->update([
            'value' => $saldo_koperasi->value - $request->total
        ]);
        return new PinjamanResource($pinjaman);
    }
}
