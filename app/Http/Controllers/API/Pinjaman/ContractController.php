<?php

namespace App\Http\Controllers\API\Pinjaman;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pinjaman\PinjamanResource;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $pinjaman_id)
    {
        $this->validate($request, [
            'contract' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        $pinjaman = Pinjaman::find($pinjaman_id);
        if($pinjaman) {
            $file_name = FileHelpers::uploadFile('images/contract_pinjaman/', $request->contract);
            $input['contract'] = $file_name;
            $pinjaman->update($input);
            return new PinjamanResource($pinjaman);
        } else {
            return response()->json([
                'message' => 'data not found'
            ]);
        }
    }
}
