<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = "quizes";

    public function questions(){
        return $this->hasMany(Question::class);
    }

     public function resultquiz(){
        return $this->hasOne(ResultQuiz::class);
    }

    public function post(){
        return $this->belongsTo(Post::class,'quiz_id');
    }
}
