<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function all(Request $request)
    {
        $user_level_id = $request->user()->user_level_id;
        $user_level_id == 1 ? $user_level_in = [1] : $user_level_in = [1, 100];
        $user = User::whereNotIn('user_level_id', $user_level_in)->paginate(15);
        return UserResource::collection($user);
    }

    public function by_id($user_id)
    {
        $user = User::find($user_id);
        if($user) {
            return new UserResource($user);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
        
    }
}
