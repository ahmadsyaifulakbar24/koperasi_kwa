<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\ReportTransactionDebitResource;
use App\Models\MainSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportTransactionController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
        ]);

        $transaction = Transaction::withSum('sub_transaction', 'besaran')
                                            ->whereNotNull('approved_date')
                                            ->whereDate('approved_date', '>=', $request->from)
                                            ->whereDate('approved_date', '<=', $request->to)
                                            ->get();
        $total_debit = $transaction->sum('sub_transaction_sum_besaran');    
        $saldo_koperasi = MainSetting::where('name_setting', 'saldo')->first();
        return response()->json([
            'saldo_koperasi' => $saldo_koperasi->value,
            'total_debit' => $total_debit,
            'transaction' => ReportTransactionDebitResource::collection($transaction)
        ], 200);
    }
}
