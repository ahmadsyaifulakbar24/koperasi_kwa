<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'device_name' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'unautorized'
            ], 401);
        }
        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ]);
    }
}
