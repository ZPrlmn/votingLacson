<!DOCTYPE html>
<html>
<head>
    <title>Vote Data</title>
    <link rel="stylesheet" href="/css/main.css">
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
    
    <h1 id="title">Vote Data</h1>
    
    <div id="votingContainer">
        <form method="POST" action="{{ route('voting.store') }}">
            @csrf

            @foreach($positions as $position)
            <fieldset>
                <legend><h2>{{ $position->name }}</h2></legend>
                <div id="candidatesContainer">
                    @foreach($position->candidates as $candidate)
                        <div id="candidatesCard">
                            <img src="{{ asset('storage/' . $candidate->image) }}" alt="Image">
                            <span>{{ $candidate->user->first_name }}, {{ $candidate->user->last_name }}</span>
                            <span>Vote Count: {{ $candidate->votes }}</span>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            @endforeach
        </form>
        <input type="hidden" id="studentIdInput" name="student_id">
    </div>
    


    <script>
    </script>
</body>
</html>
