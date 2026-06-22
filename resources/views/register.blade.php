<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register Now</h2>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<form method="POST" action="{{ route('register.store') }}">
    @csrf

    <div>
        <label>Username</label><br>
        <input type="text" name="username" required>
    </div>

    <br>

    <div>
        <label>Phone</label><br>
        <input type="text" name="phone" required>
    </div>

    <br>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <br>

    <button type="submit">
        Register
    </button>
</form>

</body>
</html>