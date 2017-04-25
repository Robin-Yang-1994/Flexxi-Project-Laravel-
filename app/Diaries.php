<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diaries extends Model
{
    protected $fillable = ['notes'];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
