<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam; 

class Question extends Model
{
    protected $fillable = ['exam_id', 'question_text'];

   
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}