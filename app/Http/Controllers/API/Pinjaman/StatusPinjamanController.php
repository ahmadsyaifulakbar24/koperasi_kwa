<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Http\Controllers\API\Transaction\TraitTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\PinjamanResource;
use App\Models\Pinjaman;

class StatusPinjamanController extends Controller
{
    use TraitTransaction;

    public function accept($pinjaman_id) 
    {
        $pinjaman = Pinjaman::find($pinjaman_id);
        if($pinjaman->status != 'approved') {
            if($pinjaman) {
                $data['status'] = 'approved';
                $data['approved_date'] = now();
                $pinjaman->update($data);
                $this->saldo_koperasi($pinjaman->besar_pinjaman, 'pinjaman');
                return new PinjamanResource($pinjaman);
            } else {
                return response()->json([
                    'message' => 'data not found'
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'data has been approved'
            ], 401);
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
