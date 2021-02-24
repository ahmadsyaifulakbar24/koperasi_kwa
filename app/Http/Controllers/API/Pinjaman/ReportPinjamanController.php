<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\ReportPinjamanKreditResource;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class ReportPinjamanController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
        ]);

        $pinjaman = Pinjaman::whereNotNull('approved_date')
                                ->whereDate('approved_date', '>=', $request->from)
                                ->whereDate('approved_date', '<=', $request->to)
                                ->get();

        $total_kredit = $pinjaman->sum('besar_pinjaman');
        return response()->json([
            'total_kredit' => $total_kredit,
            'pinjaman' => ReportPinjamanKreditResource::collection($pinjaman),
        ], 200);
    }
}
