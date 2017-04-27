<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function showHelp(){  // show help view without login
        return view('help');
    }

    public function showInformation(){ // show help view requires login
        return view('page.information');
    }
}