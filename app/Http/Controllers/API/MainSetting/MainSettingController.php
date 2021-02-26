<?php

namespace App\Http\Controllers\API\MainSetting;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainSetting\MainSettingResource;
use App\Models\MainSetting;
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
        return new MainSettingResource($data_setting); 
    }
}
