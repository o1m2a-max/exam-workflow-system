<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\ExamStateMachine;
use App\Models\Question; // ✅ ADD THIS

class Exam extends Model
{
    protected $fillable = ['title', 'state', 'start_time', 'end_time'];

    public function changeState($newState)
    {
        $stateMachine = new ExamStateMachine();
        return $stateMachine->transition($this, $newState);
    }

    // ✅ NEW: RELATIONSHIP (Exam has many questions)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}