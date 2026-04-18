<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam; // ✅ import

class Question extends Model
{
    // ✅ allow inserting data
    protected $fillable = ['exam_id', 'question_text'];

    // ✅ relationship (Question belongs to Exam)
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}