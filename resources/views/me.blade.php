<!DOCTYPE html>
<html>
<head><title>User Info</title></head>
<body>
    <h2>Authenticated User Info</h2>

    @if ($user)
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <p>User not found or not authenticated</p>
    @endif
</body>
</html>
