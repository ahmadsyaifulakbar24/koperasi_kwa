<?php

namespace App\Http\Resources\Params;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusKeluargaResource extends JsonResource
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
            'status_keluarga' => $this->param
        ];
    }
}
