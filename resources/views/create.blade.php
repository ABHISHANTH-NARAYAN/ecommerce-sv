<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
</head>
<body>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<form action="{{ url('register') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="username">USER NAME:</label>
    <input type="text"
           id="username"
           name="username"
           value="{{ old('username') }}">
    <br>

    @error('username')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="age">AGE:</label>
    <input type="number"
           id="age"
           name="age"
           value="{{ old('age') }}">
    <br>

    @error('age')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="email">EMAIL ID:</label>
    <input type="email"
           id="email"
           name="email"
           value="{{ old('email') }}">
    <br>

    @error('email')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="phone">PHONE NUMBER:</label>
    <input type="tel"
           id="phone"
           name="phone"
           value="{{ old('phone') }}">
    <br>

    @error('phone')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="image">IMAGE:</label>
    <input type="file"
           id="image"
           name="image"
           accept=".jpg,.jpeg,.png,.gif">
    <br>

    @error('image')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <button type="submit">SUBMIT</button>
</form>

</body>
</html>