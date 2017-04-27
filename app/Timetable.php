<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = ['module', 'lecturer_name', 'location', 'time', 'finish', 'date'];  // body text required

}
