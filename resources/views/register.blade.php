<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>
