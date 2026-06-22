<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>

    <h2>User Details</h2>

    <p>
        <a href="{{ route('register.index') }}">
            Back to List
        </a>
    </p>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <td>{{ $register->id }}</td>
        </tr>

        <tr>
            <th>Username</th>
            <td>{{ $register->username }}</td>
        </tr>

        <tr>
            <th>Age</th>
            <td>{{ $register->age }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $register->email }}</td>
        </tr>

        <tr>
            <th>Phone</th>
            <td>{{ $register->phone }}</td>
        </tr>

        <tr>
            <th>Image</th>
            <td>
                @if($register->image)
                    <img src="{{ asset('storage/' . $register->image) }}"
                         width="200"
                         alt="User Image">
                @else
                    No Image
                @endif
            </td>
        </tr>
    </table>

</body>
</html>