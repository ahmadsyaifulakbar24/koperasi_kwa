<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if($user) {
            $foto_ktp = $user->user_koperasi_detail->upload_ktp;
            FileHelpers::removeFile('images/ktp/'.$foto_ktp);
            $user->delete();
            return response()->json([
                'message' => 'delete success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}
