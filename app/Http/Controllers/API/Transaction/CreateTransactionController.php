<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\User;
use Illuminate\Http\Request;

class CreateTransactionController extends Controller
{
    use TraitTransaction;

    public function __invoke(Request $request)
    {
        $user_id = auth()->user()->id;
        $this->validate($request, [
            'title' => ['required', 'string'],
            'message' => ['required', 'string'],
            'sub_transaction' => ['required', 'array'],
            'sub_transaction.*.type' => ['required', 'in:simpanan_pokok,simpanan_wajib,simpanan_sukarela'],
            'sub_transaction.*.besaran' => ['required', 'numeric'],
        ]);
        $user = User::find($user_id);
        if($user) {
            // Transaction
            $transaction_data = [
                'user_id' => $user->id,
                'title' => $request->title,
                'message' => $request->message,
                'type' => 'simpanan',
            ];

            // Sub Transaction
            $sub_transaction_data = $request->sub_transaction;
            $transaction = $this->transaction($transaction_data, $sub_transaction_data);
            return new TransactionResource($transaction);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
