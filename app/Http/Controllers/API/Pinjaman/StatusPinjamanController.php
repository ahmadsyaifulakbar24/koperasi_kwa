<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\PinjamanResource;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class StatusPinjamanController extends Controller
{
    public function accept($pinjaman_id) 
    {
        $pinjaman = Pinjaman::find($pinjaman_id);
        if($pinjaman) {
            $data['status'] = 'approved';
            $data['approved_date'] = now();
            $pinjaman->update($data);
            return new PinjamanResource($pinjaman);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function reject($pinjaman_id)
    {
        $pinjaman = Pinjaman::find($pinjaman_id);
        if($pinjaman) {
            $data['status'] = 'rejected';
            $data['approved_date'] = NULL;
            $pinjaman->update($data);
            return new PinjamanResource($pinjaman);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function paid_off($pinjaman_id)
    {
        $pinjaman = Pinjaman::find($pinjaman_id);
        if($pinjaman) {
            $pinjamanData['paid_off_date'] = now();
            $pinjamanData['sisa_bayar'] = 0;
            $pinjamanData['status'] = 'paid_off';
            $pinjaman->update($pinjamanData);
            return new PinjamanResource($pinjaman);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
