<?php

namespace App\Http\Controllers\Api\MainSetting;

use App\Http\Controllers\Controller;
use App\Models\MainSetting;
use Illuminate\Http\Request;

class SaldoKopersiController extends Controller
{
    public function add_saldo(Request $request)
    {
        $this->validate($request, [
            'besaran' => ['required', 'numeric'],
        ]);

        $saldo = MainSetting::where('name_setting', 'saldo')->first();
        $total_saldo = $saldo->value + $request->besaran;
        $saldo->update([ 'value' => $total_saldo ]);
        return response()->json([
            'data' => [
                'saldo' => $saldo->value
            ]
        ]);
    }
}
