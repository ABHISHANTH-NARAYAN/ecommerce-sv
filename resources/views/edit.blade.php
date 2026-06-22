<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

```
<h2>Edit User</h2>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('register.index') }}">Back to List</a>

<br><br>

<form action="{{ route('register.update', $register->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <label for="username">Username:</label>
    <input type="text"
           id="username"
           name="username"
           value="{{ old('username', $register->username) }}">
    <br>

    @error('username')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="age">Age:</label>
    <input type="number"
           id="age"
           name="age"
           value="{{ old('age', $register->age) }}">
    <br>

    @error('age')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="email">Email:</label>
    <input type="email"
           id="email"
           name="email"
           value="{{ old('email', $register->email) }}">
    <br>

    @error('email')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <label for="phone">Phone:</label>
    <input type="text"
           id="phone"
           name="phone"
           value="{{ old('phone', $register->phone) }}">
    <br>

    @error('phone')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    @if($register->image)
        <label>Current Image:</label>
        <br>
        <img src="{{ asset('storage/' . $register->image) }}"
             width="120"
             alt="User Image">
        <br><br>
    @endif

    <label for="image">Change Image:</label>
    <input type="file"
           id="image"
           name="image"
           accept=".jpg,.jpeg,.png,.gif">
    <br>

    @error('image')
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <br><br>

    <button type="submit">Update User</button>

</form>
```

</body>
</html>



