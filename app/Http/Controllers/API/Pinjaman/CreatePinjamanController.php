<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\PinjamanResource;
use App\Models\MainSetting;
use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Http\Request;

class CreatePinjamanController extends Controller
{
    public function detail(Request $request, $user_id)
    {
        $this->validate($request, [
            'besar_pinjaman' => ['required', 'numeric'],
            'tenor' => ['required', 'numeric'],
        ]);

        $user = User::find($user_id);
        if($user) {
            $besar_pinjaman = $request->besar_pinjaman;
            $tenor = $request->tenor;
            $bunga = MainSetting::where('name_setting', 'bunga')->first();
            $bunga_perbulan = $besar_pinjaman * $bunga->value / 100;
            $total_bunga = $bunga_perbulan * $tenor;
            $angsuran = ceil($besar_pinjaman / $tenor + $bunga_perbulan);
            $total_bayar = $besar_pinjaman + $total_bunga;

            $data['user_id'] = $user->id;
            $data['angsuran'] = $angsuran;
            $data['besar_pinjaman'] = $besar_pinjaman;
            $data['tenor'] = $tenor;
            $data['total_bayar'] = $total_bayar;
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function create_pinjaman(Request $request, $user_id) {
        $this->validate($request, [
            'angsuran' => ['required', 'numeric'],
            'besar_pinjaman' => ['required', 'numeric'],
            'tenor' => ['required', 'numeric'],
            'total_bayar' => ['required', 'numeric'],
        ]);
        $user = User::find($user_id);
        if($user) {
            $data['user_id'] = $request->user_id;
            $data['angsuran'] = $request->angsuran;
            $data['besar_pinjaman'] = $request->besar_pinjaman;
            $data['tenor'] = $request->tenor;
            $data['total_bayar'] = $request->total_bayar;
            $data['sisa_bayar'] = $request->total_bayar;
            $data['total_payment'] = 0;
            $data['status'] = 'pending';
    
            $pinjaman = Pinjaman::create($data);
            return new PinjamanResource($pinjaman);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
