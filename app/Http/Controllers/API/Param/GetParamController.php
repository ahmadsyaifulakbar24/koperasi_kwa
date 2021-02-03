<?php

namespace App\Http\Controllers\API\Param;

use App\Http\Controllers\Controller;
use App\Http\Resources\Params\JabatanResource;
use App\Http\Resources\Params\PendidikanResource;
use App\Http\Resources\Params\StatusKeluargaResource;
use App\Models\Param;

class GetParamController extends Controller
{
    public function pendidikan()
    {
        $param = Param::where([['category_param', 'pendidikan'], ['active', 1]])->orderBy('order', 'ASC')->get();
        return PendidikanResource::collection($param);
    }

    public function jabatan()
    {
        $param = Param::where([['category_param', 'jabatan'], ['active', 1]])->orderBy('order', 'ASC')->get();
        return JabatanResource::collection($param);
    }

    public function status_keluarga()
    {
        $param = Param::where([['category_param', 'status_keluarga'], ['active', 1]])->orderBy('order', 'ASC')->get();
        return StatusKeluargaResource::collection($param);
    }
}
