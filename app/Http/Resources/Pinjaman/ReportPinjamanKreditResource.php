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
        return [
            'date' => $this->approved_date,
            'name' => $this->user->name,
            'nik' => $this->user->no_id,
            'tenor' => $this->tenor,
            'jumlah' => $this->besar_pinjaman,
            'bunga' => $this->besar_pinjaman * $bunga->value / 100,
            'setoran_per_bulan' => $this->angsuran,
            'keterangan' => $this->transaction->count().'/'.$this->tenor
        ];
    }
}
