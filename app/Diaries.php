<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diaries extends Model
{
    protected $fillable = ['notes']; // body text required

    public function user(){

        return $this->belongsTo(User::class);  // many to 1 to user
    }
}
