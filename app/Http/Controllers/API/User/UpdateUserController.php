<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserController extends Controller
{
    public function __invoke(Request $request, $user_id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
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
            'status_keluarga_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'status_keluarga');
                })
            ],
            'nama_ahliwaris' => ['required', 'string'],
            'besar_simpanan_wajib' => ['required', 'numeric'],
            'upload_ktp' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $user = User::find($user_id);
        if($user) {
            $input = $request->all();
            if($request->profile) {
                !empty($user->profile) ? FileHelpers::removeFile('images/profile/'.$user->profile) : '';
                $input['profile'] = FileHelpers::uploadFile('images/profile/', $request->profile);
            }
            $user->update($input);

            $inputDetail['status_keluarga_id'] = $request->status_keluarga_id;
            $inputDetail['nama_ahliwaris'] = $request->nama_ahliwaris;
            $inputDetail['besar_simpanan_wajib'] = $request->besar_simpanan_wajib;
            if($request->upload_ktp) {
                FileHelpers::removeFile('images/ktp/'.$user->user_koperasi_detail->upload_ktp);
                $ktp = FileHelpers::uploadFile('images/ktp/', $request->upload_ktp);
                $inputDetail['upload_ktp'] = $ktp;
            }
            $user->user_koperasi_detail()->update($inputDetail);

            return new UserResource($user);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
