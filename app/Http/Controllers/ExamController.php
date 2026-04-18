<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question; // ✅ ADD THIS
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        // ✅ LOAD QUESTIONS TOO (VERY IMPORTANT)
        $exams = Exam::with('questions')
                    ->where('state', '!=', 'archived')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('exams.index', compact('exams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        Exam::create([
            'title' => $request->title
        ]);

        return redirect('/exams')->with('success', 'Exam created successfully');
    }

    // ✅ NEW: ADD QUESTION
    public function addQuestion(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'required|string'
        ]);

        $exam = Exam::findOrFail($id);

        Question::create([
            'exam_id' => $exam->id,
            'question_text' => $request->question_text
        ]);

        return redirect('/exams')->with('success', 'Question added');
    }

    public function publish($id)
    {
        $exam = Exam::findOrFail($id);

        try {
            $exam->changeState('published');

            $exam->start_time = now();
            $exam->save();

            return redirect('/exams')->with('success', 'Exam published');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function start($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->changeState('ongoing');

        return redirect('/exams')->with('success', 'Exam started');
    }

    public function complete($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->changeState('completed');

        $exam->end_time = now();
        $exam->save();

        return redirect('/exams')->with('success', 'Exam completed');
    }

    public function archive($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->changeState('archived');

        return redirect('/exams')->with('success', 'Exam archived');
    }

    public function archived()
    {
        $exams = Exam::with('questions')
                    ->where('state', 'archived')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('exams.archived', compact('exams'));
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect('/exams')->with('success', 'Exam deleted');
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        return view('exams.edit', compact('exam'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $exam = Exam::findOrFail($id);

        $exam->update([
            'title' => $request->title
        ]);

        return redirect('/exams')->with('success', 'Exam updated');
    }
}