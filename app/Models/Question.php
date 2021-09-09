<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function quiz(){
        return belongsTo(Quiz::class);
    }

    public function options(){
        return hasMany(Option::class);
    }

     public function resultquiz(){
        return $this->hasOne(ResultQuiz::class);
    }
}
