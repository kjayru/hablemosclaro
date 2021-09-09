<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    public function resultquiz(){
        return $this->hasOne(ResultQuiz::class);
    }

    public function question(){
        return belongsTo(Question::class);
    }
}
