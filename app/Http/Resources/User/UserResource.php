<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Params\JabatanResource;
use App\Http\Resources\Params\PendidikanResource;
use App\Models\UserKoperasiDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'no_id' => $this->no_id,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'pendidikan' => new PendidikanResource($this->pendidikan),
            'jabatan' => new JabatanResource($this->jabatan),
            'user_level_id' => $this->user_level_id,
            'user_koperasi_detail' => new UserKoperasiDetailResource($this->user_koperasi_detail)
        ];
    }
}
