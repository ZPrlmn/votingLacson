<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates</title>
</head>
<body>
    <h1>Candidates</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('message'))
        <p style="color: red;">{{ session('message') }}</p>
    @endif

    <!-- Form to add a new candidate -->
    <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
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
    
    


    @if($candidates->isEmpty())
        <p>No candidates available.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Position</th>
                    <th>Votes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->id }}</td>
                        <td>{{ $candidate->student_id }}</td>
                        <td>{{ $candidate->position->name }}</td>
                        <td>{{ $candidate->votes }}</td>
                        <td>
                            <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
