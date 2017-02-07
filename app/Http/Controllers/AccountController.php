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

      //$user = new User(); // new object
      $this->validate($request, ['image' => 'required']);
      // some validation on any empty fields
      //$picture->profile_picture = $request->profile_picture; // defining filename as request name
        if($request->hasFile('image')) { // check if the file from request exist
        $file = Input::file('image'); // get file and define it as object
        // $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        // $name = $timestamp. '-' .$file->getClientOriginalName();
        //$user->profile_picture = $file;
        // defining filepath in DB is equal to file object
        $file->move(public_path().'/img/', $file.'.jpg');
        // storing images to public folder in tmp and add .jpg extension to file name

      $user = Auth::user();
      $user->profile_picture = $file;
      $user->save();
    }
      return view('auth.profile')->with('user', Auth::user());
    }

}
