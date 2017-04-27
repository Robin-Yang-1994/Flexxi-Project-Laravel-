<?php

namespace App\Http\Controllers;

use App\Diaries;
use Illuminate\Http\Request;
use App\User;
use App\Timetable;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
class AccountController extends Controller
{
    public function showProfile(){  // method to get user details using middleware auth token

        if(Auth::check()) { // if check statement
            $user = Auth::user()->id;
            return view('auth.profile')->with('user', Auth::user());
        }
        else{
        }
    }

    public function updateProfile(Request $request, User $user){   // validation check and fields required
        $this->validate($request, ['first_name' => 'required',
                                     'last_name' => 'required',
                                     'email' => 'required',
                                     'university' => 'required'
        ]);

        $user->update($request->all()); // update database
        Session::flash('updateSuccess', 'You Have Successfully Updated Your Profile'); // flash message using sessions
        return view('auth.profile')->with('user', Auth::user());
    }

    public function uploadProfilePicture(Request $request, User $user){  // user upload image
      $this->validate($request, ['profile_picture' => 'required'
    ]);
      // some validation on any empty fields
        if($request->hasFile('profile_picture')) { // check if the file from request exist
        $file = $request->file('profile_picture'); // get file and define it as object

        $destinationPath= 'img/'; // public folder name
        $filename = $file->getClientOriginalName();
        Input::file('profile_picture')->move($destinationPath, $filename);

      $user = Auth::user(); // save to a specific user
      $user->profile_picture = $filename; // save only the file name
      $user->save();
    }
    return view('auth.profile')->with('user', Auth::user());
    }

    public function deleteProfile(Request $request, User $user, Timetable $timetable, Task $task, Diaries $diary){
        // delete all database table related to user id
        $auth = Auth::user()->id;
        $timetableD = Timetable::where('user_id', '=', $auth)->delete();
        $taskD = Task::where('user_id', '=', $auth)->delete();
        $diaryD = Diaries::where('user_id', '=', $auth)->delete();

        $user->delete($request->all());
        Session::flash('deleteSuccess', 'You Account Has Been Successfully Deleted'); // flash message
        return redirect ('/'); // redirect to register
    }

}
