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
            'status' => ['nullable', 'in:approved,rejected,pending,paid_off'],
            'search' => ['nullable', 'string']
        ]);

        $pinjamanQuery = Pinjaman::join('users', 'users.id', '=', 'pinjaman.user_id');
        (!empty($user_id)) ? $pinjamanQuery->where('user_id', $user_id) : $pinjamanQuery;
        $status = $request->status;
        if($request->search) {
        	$pinjamanQuery->where('users.name', 'like', '%'. $request->search .'%');
        }
        if(!empty($status)) {
            $pinjamanQuery->where('status', $status);
        }

        return PinjamanResource::collection($pinjamanQuery->orderBy('pinjaman.created_at', 'desc')->paginate(15));
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
        $cek_pinjaman = Pinjaman::where([['user_id', $user_id], ['status', 'pending']])->orWhere([['user_id', $user_id], ['status', 'approved']])->count();
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
