<!DOCTYPE html>
<html>
<head>
    <title>JWT Auth Demo</title>
</head>
<body>
    <h1>JWT Auth Testing</h1>

    <h2>Register</h2>
    <form method="POST" action="/api/register">
        <input type="text" name="name" placeholder="Name"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Register</button>
    </form>

    <!-- <h2>Login</h2>
    <form method="POST" action="/api/login">
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Login</button>
    </form> -->

    <p><strong>Note:</strong> These forms will return raw JSON. To test full flow with token headers, use Postman or a React frontend.</p>
</body>
</html>
