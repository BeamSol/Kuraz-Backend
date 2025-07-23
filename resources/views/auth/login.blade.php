<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <p id="message" style="color:green"></p>

    <form id="login-form">
        @csrf
        <input type="email" name="email" id="email" placeholder="Email"><br><br>
        <input type="password" name="password" id="password" placeholder="Password"><br><br>
        <button type="submit">Login</button>
    </form>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (response.ok) {
                localStorage.setItem('token', data.authorisation.token);
                document.getElementById('message').innerText = 'Login successful. Token saved to localStorage.';
            } else {
                document.getElementById('message').innerText = data.error || 'Login failed.';
            }
        });
    </script>
</body>
</html>
