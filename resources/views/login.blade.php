<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="container">
        <div id="card1">
            <div id="imageContainer">
                <img id="imgLogo" src="/images/logo.jpg" alt="logo">
                <span id="title">Voting System</span>
                <img id="img1" src="/images/img1.png" alt="Lacson Image">
            </div>
        </div>
        <div id="card2">
            <div id="formContainer">
                <span id="loginTxt">Login</span>
                <div>
                @if(session('error'))
                    <p style="color:red;">{{ session('error') }}</p>
                @endif
            
                <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <label for="student_id">Student ID:</label>
                    <input type="text" id="student_id" name="student_id" placeholder="Student ID" required>
                    <button type="submit">Login</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const studentId = document.getElementById('student_id').value;
            localStorage.setItem('student_id', studentId);
            console.log('Student ID saved to localStorage:', localStorage.getItem('student_id'));
        });
    </script>
    
</body>
</html>
