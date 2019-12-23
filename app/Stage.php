<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function project(){
        $this->hasMany(Project::class);
    }
}
