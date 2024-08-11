<!DOCTYPE html>
<html>
<head>
    <title>Voting</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/voting.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="headerContainer">
        <div id="header">
            <img src="/images/logo.jpg" alt="Logo">
            <span>Dr. Gloria D. Lacson Foundation Colleges Voting System</span>
        </div>
    </div>
    
    <div id="votingContainer">
        <form method="POST" action="{{ route('voting.store') }}">
            @csrf

            @foreach($positions as $position)
            <fieldset>
                <legend><h1>{{ $position->name }}</h1></legend>
                <div id="candidatesContainer">
                    @foreach($position->candidates as $candidate)
                        <div id="candidatesCard">
                            <img src="{{ asset('storage/' . $candidate->image) }}" alt="Image">
                            <span>{{ $candidate->user->first_name }}, {{ $candidate->user->last_name }}</span>
                            <label id="radioLabel">
                                <input id="btnRadio" type="radio" name="votes[{{ $position->id }}]" value="{{ $candidate->student_id }}" required>
                                Vote
                            </label>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            @endforeach

            <button id="btnVote" type="submit" class="btn btn-primary" onclick="getStudentId()">Submit Vote</button>
        </form>
        <input type="hidden" id="studentIdInput" name="student_id">
    </div>
    


    <script>
document.addEventListener('DOMContentLoaded', function() {
    let studentId = localStorage.getItem('student_id');
    console.log(studentId, 'from localStorage');
    document.getElementById('studentIdDisplay').textContent = studentId;
    document.getElementById('studentIdInput').value = studentId;

    fetch('{{ route('voting.getId') }}?student_id=' + studentId)
        .then(response => response.json())
        .then(data => {
            console.log('Response from getId:', data);
        });
});


        function getStudentId() {
            // This function is triggered when the Submit Vote button is clicked
            let studentId = localStorage.getItem('student_id');
            console.log(studentId, 'from localStorage');
        }
    </script>
</body>
</html>
