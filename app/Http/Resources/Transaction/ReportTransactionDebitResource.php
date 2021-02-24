<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ReportTransactionDebitResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->user->name,
            'nik' => $this->user->no_id,
            'date' => $this->approved_date,
            'total_debit' => $this->sub_transaction_sum_besaran,
            'sub_transaction' => [
                'simpanan_wajib' => $this->sub_transaction->where('type', 'simpanan_wajib')->first()->besaran ?? NULL,
                'simpanan_sukarela' => $this->sub_transaction->where('type', 'simpanan_sukarela')->first()->besaran ?? NULL,
                'simpanan_pokok' => $this->sub_transaction->where('type', 'simpanan_pokok')->first()->besaran ?? NULL,
                'cicilan' => $this->sub_transaction->where('type', 'tagihan_pinjaman')->first()->besaran ?? NULL,
                'total' => $this->sub_transaction_sum_besaran,
            ]
        ];
    }
}
