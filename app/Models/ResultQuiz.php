<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultQuiz extends Model
{
    use HasFactory;
    protected $table = "result_quizes";

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);

    }
    public function option(){
        return $this->belongsTo(Option::class);
    }
}
