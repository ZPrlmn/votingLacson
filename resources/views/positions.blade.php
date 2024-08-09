<!DOCTYPE html>
<html>
<head>
    <title>Positions</title>
</head>
<body>
    <h2>Positions</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        <label for="position_name">Position Name:</label>
        <input type="text" id="position_name" name="position_name" required>
        <button type="submit">Add Position</button>
    </form>
    

    <h3>Existing Positions</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($positions as $position)
                <tr>
                    <td>{{ $position->id }}</td>
                    <td>{{ $position->name }}</td>
                    <td>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
