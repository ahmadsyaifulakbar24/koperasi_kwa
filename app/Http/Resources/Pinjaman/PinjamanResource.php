<?php

namespace App\Http\Resources\Pinjaman;

use App\Http\Resources\Transaction\TransactionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PinjamanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => !empty($this->id) ? $this->id : NULL,
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'transaction_type' => $this->transaction_type,
            'angsuran' => !empty($this->angsuran) ? $this->angsuran : NULL,
            'description' => !empty($this->description) ? $this->description : NULL,
            'besar_pinjaman' => !empty($this->besar_pinjaman) ? $this->besar_pinjaman : NULL,
            'tenor' => !empty($this->tenor) ? $this->tenor : NULL,
            'total_bayar' => !empty($this->total_bayar) ? $this->total_bayar : NULL,
            'sisa_bayar' => !empty($this->sisa_bayar) ? $this->sisa_bayar : NULL,
            'status' => !empty($this->status) ? $this->status : NULL,
            'approved_date' => !empty($this->approved_date) ? \Carbon\Carbon::parse($this->approved_date)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') : NULL,
            'paid_off_date' => !empty($this->paid_off_date) ? \Carbon\Carbon::parse($this->paid_off_date)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') : NULL,
            'created_at' => !empty($this->created_at) ? \Carbon\Carbon::parse($this->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') : NULL,
            'transaction' => !empty($this->transaction) ? TransactionResource::collection($this->transaction) : NULL,
            'contract' => !empty($this->contract) ? asset('images/contract_pinjaman/'.$this->contract) : NULL,
        ];
    }
}
