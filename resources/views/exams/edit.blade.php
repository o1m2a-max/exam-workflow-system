<!DOCTYPE html>
<html>
<head>
    <title>Edit Exam</title>
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

<div style="max-width:500px; margin:auto;">

    <h2 style="text-align:center;">Edit Exam</h2>

    <!-- ✅ SUCCESS / ERROR -->
    @if(session('success'))
        <p style="color:green; text-align:center;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div style="color:red; margin-bottom:10px;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- ✅ EDIT FORM -->
    <form action="/exams/{{ $exam->id }}" method="POST" style="background:white; padding:20px; border-radius:10px;">
        @csrf
        @method('PUT')

        <label style="font-weight:bold;">Exam Title</label>

        <input 
            type="text" 
            name="title" 
            value="{{ old('title', $exam->title) }}"
            required
            style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;"
        >

        <button 
            type="submit"
            style="width:100%; padding:10px; background:blue; color:white; border:none; border-radius:5px;">
            Update Exam
        </button>

    </form>

    <!-- ✅ BACK BUTTON -->
    <div style="text-align:center; margin-top:15px;">
        <a href="/exams" style="text-decoration:none; color:black;">
            ← Back to Exams
        </a>
    </div>

</div>

</body>
</html>