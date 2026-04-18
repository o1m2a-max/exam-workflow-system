<!DOCTYPE html>
<html>
<head>
    <title>Exam List</title>
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

<h1 style="text-align:center;">All Exams</h1>

<!-- VIEW ARCHIVED -->
<div style="text-align:center; margin-bottom:15px;">
    <a href="/exams/archived"
       style="background:gray; color:white; padding:8px 15px; border-radius:5px; text-decoration:none;">
       View Archived Exams
    </a>
</div>

<!-- MESSAGES -->
@if(session('success'))
    <p style="color:green; text-align:center;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red; text-align:center;">{{ session('error') }}</p>
@endif

<!-- CREATE EXAM -->
<div style="max-width:600px; margin:auto; margin-bottom:20px;">
    <form action="/exams" method="POST" style="background:white; padding:15px; border-radius:10px;">
        @csrf

        <h3>Create New Exam</h3>

        <input 
            type="text" 
            name="title" 
            placeholder="Enter exam title"
            required
            style="width:100%; padding:8px; margin-bottom:10px;"
        >

        <button 
            type="submit"
            style="padding:8px 12px; background:black; color:white; border:none; border-radius:5px;">
            Create Exam
        </button>
    </form>
</div>

<!-- EXAMS -->
<div style="max-width:600px; margin:auto;">

@foreach($exams as $exam)
    <div style="background:white; border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:10px;">
        
        <h3>{{ $exam->title }}</h3>

        <p>
            <strong>State:</strong> 
            <span style="color:blue; font-weight:bold;">
                {{ ucfirst($exam->state) }}
            </span>
        </p>

        @if($exam->start_time)
            <p><strong>Started:</strong> {{ $exam->start_time }}</p>
        @endif

        @if($exam->end_time)
            <p><strong>Ended:</strong> {{ $exam->end_time }}</p>
        @endif

        <!-- ✅ QUESTIONS LIST -->
        <div style="margin-top:10px;">
            <strong>Questions:</strong>

            @if($exam->questions->isEmpty())
                <p style="color:gray;">No questions yet.</p>
            @else
                <ul>
                    @foreach($exam->questions as $q)
                        <li>{{ $q->question_text }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- ✅ ADD QUESTION FORM -->
        @if($exam->state != 'archived')
        <form action="/exams/{{ $exam->id }}/questions" method="POST" style="margin-top:10px;">
            @csrf

            <input 
                type="text" 
                name="question_text"
                placeholder="Add a question..."
                required
                style="width:70%; padding:6px;"
            >

            <button style="padding:6px 10px; background:#333; color:white; border:none;">
                Add
            </button>
        </form>
        @endif

        <!-- ACTION BUTTONS -->
        <div style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;">

            @if($exam->state == 'draft')
                <form action="/exams/{{ $exam->id }}/publish" method="POST">
                    @csrf
                    <button style="background:green; color:white; padding:6px 12px; border:none; border-radius:5px;">
                        Publish
                    </button>
                </form>
            @endif

            @if($exam->state == 'published')
                <form action="/exams/{{ $exam->id }}/start" method="POST">
                    @csrf
                    <button style="background:orange; color:white; padding:6px 12px; border:none; border-radius:5px;">
                        Start
                    </button>
                </form>
            @endif

            @if($exam->state == 'ongoing')
                <form action="/exams/{{ $exam->id }}/complete" method="POST">
                    @csrf
                    <button style="background:red; color:white; padding:6px 12px; border:none; border-radius:5px;">
                        Complete
                    </button>
                </form>
            @endif

            @if($exam->state == 'completed')
                <form action="/exams/{{ $exam->id }}/archive" method="POST">
                    @csrf
                    <button style="background:purple; color:white; padding:6px 12px; border:none; border-radius:5px;">
                        Archive
                    </button>
                </form>
            @endif

            <!-- EDIT -->
            <a href="/exams/{{ $exam->id }}/edit"
               style="background:blue; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">
               Edit
            </a>

            <!-- DELETE -->
            <form action="/exams/{{ $exam->id }}" method="POST"
                  onsubmit="return confirm('Delete this exam?');">
                @csrf
                @method('DELETE')

                <button style="background:black; color:white; padding:6px 12px; border:none; border-radius:5px;">
                    Delete
                </button>
            </form>

        </div>

    </div>
@endforeach

</div>

</body>
</html>