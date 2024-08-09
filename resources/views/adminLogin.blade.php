<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
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
                <span id="loginTxt">Admin Login</span>
            @if(session('error'))
                <p style="color:red;">{{ session('error') }}</p>
            @endif

            <form id="loginForm" method="POST" action="{{ url('/admin/login') }}">
                @csrf
                <label for="user_name">User Name:</label>
                <input type="text" id="user_name" name="user_name" placeholder="User Name" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    
    </script>
    
</body>
</html>
