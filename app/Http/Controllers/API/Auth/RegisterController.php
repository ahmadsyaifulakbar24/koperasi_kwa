<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\FileHelpers;
use App\Http\Controllers\API\Transaction\TraitTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\MainSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    use TraitTransaction; 

    public function __invoke(Request $request)
    {   
        // validasi form register
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'no_id' => ['required', 'numeric', 'unique:users,no_id'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'digits_between:8,15'],
            'pendidikan_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'pendidikan');
                })
            ],
            'jabatan_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'jabatan');
                })
            ],
            'user_level_id' => ['required', 'exists:user_levels,id'],
            'status_keluarga_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'status_keluarga');
                })
            ],
            'nama_ahliwaris' => ['required', 'string'],
            'besar_simpanan_wajib' => ['required', 'numeric'],
            'simpanan_sukarela' => ['required', 'numeric'],
            'upload_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        // insert user
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);

        // insert detail user
        $inputDetail['status_keluarga_id'] = $request->status_keluarga_id;
        $inputDetail['nama_ahliwaris'] = $request->nama_ahliwaris;
        $inputDetail['besar_simpanan_wajib'] = $request->besar_simpanan_wajib;
        $ktp = FileHelpers::uploadFile('images/ktp/', $request->upload_ktp);
        $inputDetail['upload_ktp'] = $ktp;
        $user_koperasi_detail = $user->user_koperasi_detail()->create($inputDetail);

        // insert transaction
        $transaction_data = [
            'user_id' => $user->id,
            'title' => 'Tagihan Pertama',
            'message' => 'ini adalah pesan',
            'type' => 'simpanan',
        ];
        $simpanan_pokok = MainSetting::where('name_setting', 'simpanan_pokok')->first();
        $sub_transaction_data = [
            [ 'type' => 'simpanan_pokok', 'besaran' => $simpanan_pokok->value ],
            [ 'type' => 'simpanan_wajib', 'besaran' => $user_koperasi_detail->besar_simpanan_wajib],
            [ 'type' => 'simpanan_sukarela', 'besaran' => $request->simpanan_sukarela ],
        ];
        $this->transaction($transaction_data, $sub_transaction_data);
        
        return new UserResource($user);
    }
}
