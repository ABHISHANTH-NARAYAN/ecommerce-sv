<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User List</title>
</head>
<body>

    <!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User List</title>
</head>
<body>

```
<h2>Registered Users</h2>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Age</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($registers as $register)
            <tr>
                <td>{{ $register->id }}</td>
                <td>{{ $register->username }}</td>
                <td>{{ $register->age }}</td>
                <td>{{ $register->email }}</td>
                <td>{{ $register->phone }}</td>

                <td>
                    @if($register->image)
                        <img src="{{ asset('storage/' . $register->image) }}"
                             width="80"
                             height="80"
                             alt="User Image">
                    @else
                        No Image
                    @endif
                </td>

                <td>
                    <a href="{{ route('register.show', $register->id) }}">
                        View
                    </a>

                    |

                    <a href="{{ route('register.edit', $register->id) }}">
                        Edit
                    </a>

                    |

                    <form action="{{ route('register.destroy', $register->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this record?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No records found</td>
            </tr>
        @endforelse
    </tbody>
</table>
```

</body>
</html>