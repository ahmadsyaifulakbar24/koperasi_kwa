<?php

namespace App\Http\Resources\MainSetting;

use Illuminate\Http\Resources\Json\JsonResource;

class MainSettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'bunga' => $this['bunga'],
            'simpanan_pokok' => $this['simpanan_pokok'],
        ];
    }
}
