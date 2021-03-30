<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function group(){
        return $this->hasMany('App\Models\Group', 'department_id' , 'id');
    }
}
