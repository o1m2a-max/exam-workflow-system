<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\ExamStateMachine;
use App\Models\Question; 

class Exam extends Model
{
    protected $fillable = ['title', 'state', 'start_time', 'end_time'];

    public function changeState($newState)
    {
        $stateMachine = new ExamStateMachine();
        return $stateMachine->transition($this, $newState);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}