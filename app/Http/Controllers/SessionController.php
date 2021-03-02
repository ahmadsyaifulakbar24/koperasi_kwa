<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
	public function createSession(Request $request) {
		$request->session()->put('token',$request->token);
		$request->session()->put('user_id',$request->user_id);
		$request->session()->put('level',$request->level);
	}

	public function deleteSession(Request $request) {
		$request->session()->forget('token');
		$request->session()->forget('user_id');
		$request->session()->forget('level');
	}
}