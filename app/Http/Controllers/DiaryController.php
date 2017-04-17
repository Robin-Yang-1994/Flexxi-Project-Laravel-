<?php

namespace App\Http\Controllers;
use Auth;
use App\Diaries;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    public function updateDiary(Request $request, Diaries $diaries){

        $diaries->update($request->all());
        return redirect('/home');
    }
}
