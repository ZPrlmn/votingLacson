<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/candidates.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates</title>
</head>
<body>
    <div id="headerContainer">
        <div id="header">
            <img src="/images/logo.jpg" alt="Logo">
            <span>Dr. Gloria D. Lacson Foundation Colleges Voting System</span>
        </div>
    </div>
    <h1>Candidates</h1>
    <div id="container">
        <div id="inputContainer">
            <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
            
                @if(session('message'))
                    <p style="color: red;">{{ session('message') }}</p>
                @endif
                @csrf
                <label for="uploadImage">Upload 2x2 Image with .jpg, .jpeg, .png</label>
                <input type="file" id="uploadImage" accept=".jpg, .jpeg, .png" name="img">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" required>
                
                <label for="position_id">Position:</label>
                <select id="position_id" name="position_id" required>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit">Add Candidate</button>
            </form>
        </div>
         
        <div id="contentContainer">
            @if($candidates->isEmpty())
                <p>No candidates available.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Position</th>
                            <th>Votes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($candidates as $candidate)
                            <tr>
                                <td>{{ $candidate->student_id }}</td>
                                <td>{{ $candidate->position->name }}</td>
                                <td>{{ $candidate->votes }}</td>
                                <td id="btnDeleteContainer">
                                    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button id="btnDelete" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</body>
</html>
