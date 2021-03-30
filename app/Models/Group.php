<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post', 'group_posts', 'group_id', 'post_id');
        // return $this->belongsToMany('App\Product', 'products_shops', 'shops_id', 'products_id');
    }

    
    public function department(){
        return $this->hasone('App\Models\Department', 'id' , 'department_id');
    }
}
