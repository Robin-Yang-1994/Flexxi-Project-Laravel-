<?php

namespace App\Http\Controllers\Auth;

use App\Diaries;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [        // set format before enter data into database
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'university' => 'required|max:255',
            'dob' => 'required|date|date_format:Y-m-d',
            'gender' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('success', 'Thank You, You Have Successfully Registered'); // flash message

        $user = User::create([  // create user account with information
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'university' => $data['university'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],

        ]);

        $data['first_name']  = $user->first_name; // get first name

        Mail::send('emails.welcomeUser', $data, function($message) use ($data) // send user welcome email
        {
            $message->from('NoReplyFlexxi@support.com', "Flexxi support");
            $message->subject("Welcome to Flexxi");
            $message->to($data['email']);
        });

        $id = $user->id;  // initialise id after user is created

        $diaries = new Diaries();  // create new diary entry for user
        $text = "Enter your notes here";
        $diaries->user_id = $id;
        $diaries->notes = $text;
        $diaries->save();

        return $user;
    }
}
