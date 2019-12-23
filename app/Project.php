<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    protected $with = ['stage','invoice'];

    public function invoice(){
        return $this->hasMany('App\Invoice');
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function stage(){
        return $this->belongsTo(Stage::class);
    }

}
