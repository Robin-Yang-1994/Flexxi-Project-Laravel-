<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
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
                                     'university' => 'required'
        ]);

        $user->update($request->all());
        return view('auth.profile')->with('user', Auth::user());
    }

    public function uploadProfilePicture(Request $request, User $user){
      $this->validate($request, ['profile_picture' => 'required'
    ]);
      // some validation on any empty fields
        if($request->hasFile('profile_picture')) { // check if the file from request exist
        $file = $request->file('profile_picture'); // get file and define it as object

        $destinationPath= 'img/';
        $filename = $file->getClientOriginalName();
        Input::file('profile_picture')->move($destinationPath, $filename);

      $user = Auth::user();
      $user->profile_picture = $filename;
      $user->save();
    }
    return view('auth.profile')->with('user', Auth::user());
    }

}
