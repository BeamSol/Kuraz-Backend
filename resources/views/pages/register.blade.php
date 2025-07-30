<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h1>Register</h1>
<form id="registerForm">
    <input type="text" placeholder="Name" name="name" required><br>
    <input type="email" placeholder="Email" name="email" required><br>
    <input type="password" placeholder="Password" name="password" required><br>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>
    <button type="submit">Register</button>
</form>

<script>
document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const form = e.target;
    const response = await fetch('/api/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name: form.name.value,
            email: form.email.value,
            password: form.password.value,
            role: form.role.value
        })
    });
    const data = await response.json();
    if (data.token) {
        localStorage.setItem('token', data.token);
        window.location.href = '/dashboard';
    } else {
        alert(data.message || 'Registration failed');
    }
});
</script>
</body>
</html>
