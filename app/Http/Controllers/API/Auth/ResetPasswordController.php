<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'old_password' => ['required', 'string', 'min:8'],
        ]);
        if(Hash::check($request->old_password, auth()->user()->password)) {
            $user = User::find(auth()->user()->id);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'reset password success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'previous password are not the same'
            ], 401);
        }
        
    }
}
