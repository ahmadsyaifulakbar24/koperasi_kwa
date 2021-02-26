<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\MainSetting;
use App\Models\Pinjaman;
use App\Models\Transaction;
use App\Models\User;

class AcceptTransactionController extends Controller
{
    use TraitTransaction;
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

            $total2 = 0;
            $sub_transaction_all = $transaction->sub_transaction()->get();
            foreach($sub_transaction_all as $transaction_all) {
                $total2 += $transaction_all->besaran;
            }
            $this->saldo_koperasi($total2, 'simpanan');

            if($transaction->type == 'simpanan') {
                $user = User::find($transaction->user_id);
                $saldo_simpanan = $user->user_koperasi_detail->saldo_simpanan;
                $userData['saldo_simpanan'] = $saldo_simpanan + $total;
                $user->user_koperasi_detail->update($userData);
            } else {
                $pinjaman = Pinjaman::find($transaction->pinjaman_id);
                $bunga = MainSetting::where('name_setting', 'bunga')->first();
                $bunga_pinjaman = $pinjaman->besar_pinjaman * $bunga->value / 100;
                $potongan = $total2 - $bunga_pinjaman;
                $pinjamanData['sisa_bayar'] = $pinjaman['sisa_bayar'] - $potongan;
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
