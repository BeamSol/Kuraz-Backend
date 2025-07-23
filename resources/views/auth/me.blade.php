<!DOCTYPE html>
<html>
<head>
    <title>User Info</title>
</head>
<body>
    <h2>Authenticated User Info</h2>
    <div id="userInfo">Loading...</div>

    <script>
        const token = localStorage.getItem('token'); // You must have set this during login

        fetch('http://127.0.0.1:8000/api/me', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const userDiv = document.getElementById('userInfo');
            if (data.user) {
                userDiv.innerHTML = `
                    <p><strong>Name:</strong> ${data.user.name}</p>
                    <p><strong>Email:</strong> ${data.user.email}</p>
                `;
            } else {
                userDiv.innerHTML = `<p>User not found or not authenticated</p>`;
            }
        })
        .catch(err => {
            document.getElementById('userInfo').innerHTML = `<p>Error fetching user info</p>`;
            console.error(err);
        });
    </script>
    <button onclick="logout()">Logout</button>
<script>
    function logout() {
        localStorage.removeItem('token');
        window.location.href = '/login2';
    }
</script>

</body>
</html>
