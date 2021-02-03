<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;

class AcceptTransactionController extends Controller
{
    public function __invoke($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $input['approved_date'] = now();
        $transaction->update($input);
        return new TransactionResource($transaction);
    }
}
