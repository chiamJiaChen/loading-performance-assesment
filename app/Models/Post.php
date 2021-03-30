<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function group()
    {
    	return $this->belongsToMany('App\Models\Group', 'group_posts', 'post_id', 'group_id');
        // return $this->belongsToMany('App\Product', 'products_shops', 'shops_id', 'products_id');

    }
}
