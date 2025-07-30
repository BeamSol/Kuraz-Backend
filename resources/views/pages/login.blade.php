<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h1>Login</h1>
<form id="loginForm">
    <input type="email" placeholder="Email" name="email" required><br>
    <input type="password" placeholder="Password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<script>
document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const form = e.target;
    const response = await fetch('/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            email: form.email.value,
            password: form.password.value
        })
    });
    const data = await response.json();
    if (data.token) {
        localStorage.setItem('token', data.token);
        window.location.href = '/dashboard';
    } else {
        alert(data.message || 'Login failed');
    }
});
</script>
</body>
</html>
