<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class UserController extends Controller
{
  	public function saml_logout(Request $request) {
  		$user = User::where('email', $request->EMAIL)->first();
 
  		if ($user) {
  			Auth::logout();
  			return redirect()->intended($request->serviceurl);
  		}

  		return redirect('/');
  	} 
}
