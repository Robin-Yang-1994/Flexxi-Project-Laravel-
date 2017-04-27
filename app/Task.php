<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'description','due_date'];  // body text required

    public function user(){

        return $this->belongsTo(User::class); // many to 1 relationship
    }
}
