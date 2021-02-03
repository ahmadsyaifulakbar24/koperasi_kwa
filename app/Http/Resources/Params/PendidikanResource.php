<?php

namespace App\Http\Resources\Params;

use Illuminate\Http\Resources\Json\JsonResource;

class PendidikanResource extends JsonResource
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
            'pendidikan' => $this->param
        ];
    }
}
