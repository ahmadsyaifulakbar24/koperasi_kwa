<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
