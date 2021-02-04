<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Pinjaman;
use App\Models\Transaction;
use App\Models\User;

class AcceptTransactionController extends Controller
{
    public function __invoke($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        if($transaction && !$transaction->approved_date) {
            $input['approved_date'] = now();
            $transaction->update($input);
            $sub_transactions = $transaction->sub_transaction()->where('type', '!=', 'simpanan_pokok')->get();
            $total = 0;
            foreach($sub_transactions as $sub_transaction) {
                $total += $sub_transaction->besaran; 
            }
            if($transaction->type == 'simpanan') {
                $user = User::find($transaction->user_id);
                $saldo_simpanan = $user->user_koperasi_detail->saldo_simpanan;
                $userData['saldo_simpanan'] = $saldo_simpanan + $total;
                $user->user_koperasi_detail->update($userData);
            } else {
                $pinjaman = Pinjaman::find($transaction->pinjaman_id);
                $pinjamanData['sisa_bayar'] = $pinjaman['sisa_bayar'] - $total;
                $pinjaman->update($pinjamanData);
            }
            return new TransactionResource($transaction);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
