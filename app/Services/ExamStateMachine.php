<?php

namespace App\Services;

use App\States\ExamState;
use Exception;

class ExamStateMachine
{
    private $transitions = [
        ExamState::DRAFT => [ExamState::PUBLISHED],
        ExamState::PUBLISHED => [ExamState::ONGOING],
        ExamState::ONGOING => [ExamState::COMPLETED],
        ExamState::COMPLETED => [ExamState::ARCHIVED],
        ExamState::ARCHIVED => [],
    ];

    public function canTransition($current, $next)
    {
        return in_array($next, $this->transitions[$current] ?? []);
    }

    public function transition($exam, $nextState)
    {
        if (!$this->canTransition($exam->state, $nextState)) {
            throw new Exception("Invalid transition from {$exam->state} to {$nextState}");
        }

        $exam->state = $nextState;
        $exam->save();

        return $exam;
    }
}