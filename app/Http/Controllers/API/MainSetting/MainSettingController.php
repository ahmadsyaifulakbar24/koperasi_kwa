<?php

namespace App\Http\Controllers\API\MainSetting;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainSetting\MainSettingResource;
use App\Models\MainSetting;
use App\Models\Pinjaman;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MainSettingController extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'bunga' => ['required', 'numeric'],
            'simpanan_pokok' => ['required', 'numeric']
        ]);
        $input = $request->all();
        foreach($input as $key => $value) {
            $main_setting = MainSetting::where('name_setting', $key)->first();
            $main_setting->update(['value', $value]);
        }
        $main_setting_all = MainSetting::all();
        $data_setting = [];
        foreach ($main_setting_all as $setting) {
            $data_setting[$setting->name_setting] = $setting->value;
            $data_setting[$setting->name_setting] = $setting->value;
        }
        return new MainSettingResource($data_setting); 
    }

    public function getData()
    {
        $main_setting_all = MainSetting::all();
        $data_setting = [];
        foreach ($main_setting_all as $setting) {
            $data_setting[$setting->name_setting] = $setting->value;
        }

        $total_kredit = Pinjaman::whereNotNull('approved_date')->get()->sum('besar_pinjaman');
        $data_setting['total_kredit'] = $total_kredit;

        $total_debit = Transaction::withSum('sub_transaction', 'besaran') ->whereNotNull('approved_date') ->get()->sum('sub_transaction_sum_besaran');
        $data_setting['total_debit'] = $total_debit;
        
        return new MainSettingResource($data_setting); 
    }
}
