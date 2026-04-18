<!DOCTYPE html>
<html>
<head>
    <title>Archived Exams</title>
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

<h1 style="text-align:center;">Archived Exams</h1>

<!-- BACK BUTTON -->
<div style="text-align:center; margin-bottom:20px;">
    <a href="/exams"
       style="background:black; color:white; padding:8px 15px; border-radius:5px; text-decoration:none;">
       Back to Active Exams
    </a>
</div>

<!-- EMPTY STATE -->
@if($exams->isEmpty())
    <p style="text-align:center; color:gray;">No archived exams yet.</p>
@endif

<!-- LIST -->
<div style="max-width:600px; margin:auto;">

@foreach($exams as $exam)
    <div style="background:white; border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:10px;">
        
        <h3>{{ $exam->title }}</h3>

        <p>
            <strong>State:</strong> 
            <span style="color:gray; font-weight:bold;">Archived</span>
        </p>

        @if($exam->start_time)
            <p><strong>Started:</strong> {{ $exam->start_time }}</p>
        @endif

        @if($exam->end_time)
            <p><strong>Ended:</strong> {{ $exam->end_time }}</p>
        @endif

    </div>
@endforeach

</div>

</body>
</html>