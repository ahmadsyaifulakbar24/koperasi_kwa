<?php

namespace App\Http\Controllers\API\Transaction;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UploadBuktiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $transaction_id)
    {
        $this->validate($request, [
            'bukti_pembayaran' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        $transaction = Transaction::find($transaction_id);
        if(empty($transaction->bukti_pembayaran)) {
            $bukti_pembayaran = FileHelpers::uploadFile('images/bukti_pembayaran/', $request->bukti_pembayaran);
            $input['bukti_pembayaran'] = $bukti_pembayaran;
            $transaction->update($input);
            return new TransactionResource($transaction); 
        } else {
            return response()->json([
                'message' => 'file already exists'
            ], 401);
        }
    }
}
