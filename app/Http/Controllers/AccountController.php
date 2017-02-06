<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class AccountController extends Controller
{
    public function showProfile(){

        if(Auth::check()) {
            $user = Auth::user()->id;

            return view('auth.profile')->with('user', Auth::user());
        }
        else{
        }
    }

    public function updateProfile(Request $request, User $user){
        $this->validate($request, ['first_name' => 'required',
                                    'last_name' => 'required',
                                    'email' => 'required',
                                    'password' => 'required',
                                    'university' => 'required'
        ]);

        $user->update($request->all());
        return back();
    }
}
