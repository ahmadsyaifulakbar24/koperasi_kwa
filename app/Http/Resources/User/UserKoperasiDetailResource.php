<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Params\StatusKeluargaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserKoperasiDetailResource extends JsonResource
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
            'status_keluarga' => new StatusKeluargaResource($this->status_keluarga),
            'nama_ahliwaris' => $this->nama_ahliwaris,
            'bersar_simpanan_wajib' => $this->besar_simpanan_wajib,
            'upload_ktp' => asset('images/ktp/'.$this->upload_ktp),
            'saldo_simpanan' => !empty($this->saldo_simpanan) ? $this->saldo_simpanan : 0
        ];
    }
}
