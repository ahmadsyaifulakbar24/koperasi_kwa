<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

trait TraitTransaction
{
    public function transaction($transaction_data, $sub_transaction_data)
    {
        $transaction = Transaction::create($transaction_data);
        $transaction->sub_transaction()->createMany($sub_transaction_data); 
        return $transaction;
    }
}
