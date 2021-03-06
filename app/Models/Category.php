<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    public function parent(){
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function pariente(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
}
