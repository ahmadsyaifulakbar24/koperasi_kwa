<?php

namespace App\Http\Resources\Transaction;

use App\Models\SubTransaction;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'message' => $this->message,
            'bukti_pembayaran' => !empty($this->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$this->bukti_pembayaran) : NULL,
            'approved_date' => $this->approved_date,
            'sub_transaction' => SubTransactionResource::collection($this->sub_transaction),
            'created_at' => $this->created_at,
        ];
    }
}
