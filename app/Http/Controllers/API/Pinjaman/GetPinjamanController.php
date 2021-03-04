<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\PinjamanResource;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class GetPinjamanController extends Controller
{
    
    public function filter(Request $request, $user_id = NULL)
    {
        $this->validate($request, [
            'status' => ['nullable', 'in:approved,rejected,pending,paid_off']
        ]);

        !empty($user_id) ? $pinjamanQuery = Pinjaman::where('user_id', $user_id) : $pinjamanQuery = new Pinjaman;
        $status = $request->status;
        if(!empty($status)) {
            $pinjaman = $pinjamanQuery->where('status', $status)->paginate(15);
        } else {
            $pinjaman = $pinjamanQuery->paginate(15);
        }

        return PinjamanResource::collection($pinjaman);
    }

    public function byId($pinjaman_id)
    {
        $pinjaman = Pinjaman::find($pinjaman_id);
        if($pinjaman) {
            return new PinjamanResource($pinjaman);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function cek_pinjaman()
    {
        $user_id = auth()->user()->id;
        $cek_pinjaman = Pinjaman::where([['user_id', $user_id], ['paid_off_date']])->count();
        if($cek_pinjaman > 0) {
            $cek = 'false';
        } else {
            $cek = 'true';
        }

        return response()->json([
            'data' => [
                'output' => $cek
            ]
        ]);
    }
}
