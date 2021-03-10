<?php

namespace App\Http\Resources\Pinjaman;

use App\Models\MainSetting;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportPinjamanKreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $bunga = MainSetting::where('name_setting', 'bunga')->first();
        $transaction_type = $this->transaction_type;
        if($transaction_type != 'pinjaman') {
            $description = $this->description;
            $bunga = NULL;
        } else {
            $description = $this->transaction->count().' dari '.$this->tenor;
            $bunga = $this->besar_pinjaman * $bunga->value / 100;
        }
        return [
            'date' => $this->approved_date,
            'name' => $this->user->name,
            'nik' => $this->user->no_id,
            'jenis_transaksi' => $this->transaction_type,
            'tenor' => !empty($this->tenor) ? $this->tenor : NULL,
            'jumlah' => $this->besar_pinjaman,
            'bunga' => $bunga,
            'setoran_per_bulan' => !empty($this->angsuran) ? $this->angsuran : NULL,
            'keterangan' => $description,
        ];
    }
}
