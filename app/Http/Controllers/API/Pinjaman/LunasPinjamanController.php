<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Helpers\FileHelpers;
use App\Http\Controllers\API\Transaction\TraitTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\MainSetting;
use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Http\Request;

class LunasPinjamanController extends Controller
{
    use TraitTransaction;
    
    public function info_lunas($pinjaman_id)
    {
        $pinjaman = Pinjaman::find($pinjaman_id);
        $bunga = MainSetting::where('name_setting', 'bunga')->first();
        if($pinjaman) {
            $hutang_pokok = $pinjaman->sisa_bayar;
            $hutang_bunga = $pinjaman->besar_pinjaman * $bunga->value / 100;
            return response()->json([
                'data' => [
                    'hutang_pokok' => $hutang_pokok,
                    'bunga' =>  $hutang_bunga,
                    'total_bayar' => $hutang_pokok + $hutang_bunga
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function create_pinjaman_lunas(Request $request, $pinjaman_id)
    {
        $this->validate($request, [
            'bukti_pembayaran' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'total_bayar' => ['required', 'numeric'],
        ]);

        $pinjaman = Pinjaman::find($pinjaman_id);

        if($pinjaman) {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $bukti_pembayaran = FileHelpers::uploadFile('images/bukti_pembayaran/', $request->bukti_pembayaran);
    
            // Transaction data
            $transaction_data = [
                'user_id'  => $user->id,
                'pinjaman_id' => $pinjaman->id,
                'title' => 'Melunasi Pinjaman',
                'type' => 'pinjaman',
                'bukti_pembayaran' => $bukti_pembayaran,
            ];
    
            // Sub Transaction Data
            $sub_transaction_data = [
                [
                    'type' => 'tagihan_pinjaman',
                    'besaran' => $request->total_bayar
                ]
            ];
    
            $transaction = $this->transaction($transaction_data, $sub_transaction_data);
            return new TransactionResource($transaction);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
