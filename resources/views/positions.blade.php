<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/candidates.css">
    <link rel="stylesheet" href="/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Positions</title>
</head>
<body>
    <div id="headerContainer">
        <div id="header">
            <img src="/images/logo.jpg" alt="Logo">
            <span>Dr. Gloria D. Lacson Foundation Colleges Voting System</span>
        </div>
    </div>
    <h1>Positions</h1>
    <div id="container">
        <div id="inputContainer">
    
            @if(session('success'))
                <p style="color:green;">{{ session('success') }}</p>
            @endif
        
            <form action="{{ route('positions.store') }}" method="POST">
                @csrf
                <label for="position_name">Position Name:</label>
                <input type="text" id="position_name" name="position_name" required>
                <button type="submit">Add Position</button>
            </form>
        </div>
        
        <div id="contentContainer">
            <table>
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
                            <td id="btnDeleteContainer">
                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button id="btnDelete" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
