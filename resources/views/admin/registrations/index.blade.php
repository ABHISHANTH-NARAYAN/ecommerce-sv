<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrations</title>

<style>
    body {
        margin: 0;
        font-family: system-ui, Arial, sans-serif;
        background: #f4f6fb;
        color: #111827;
    }

    .container {
        max-width: 1100px;
        margin: auto;
        padding: 25px;
    }

    .header {
        margin-bottom: 20px;
    }

    h1 {
        margin: 0;
        font-size: 28px;
    }

    .success {
        background: #dcfce7;
        color: #166534;
        padding: 12px 15px;
        border-radius: 12px;
        margin: 15px 0;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #111827;
        color: #fff;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .delete-btn {
        background: #ef4444;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.2s;
    }

    .delete-btn:hover {
        background: #dc2626;
    }

    .email {
        color: #4f46e5;
    }

    .date {
        color: #6b7280;
        font-size: 13px;
    }

    .empty {
        text-align: center;
        padding: 20px;
        color: #6b7280;
    }

    @media(max-width: 768px) {
        th, td {
            font-size: 13px;
        }
    }
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>Registered Users</h1>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($registrations as $registration)

                <tr>

                    <td><strong>{{ $registration->username }}</strong></td>

                    <td>{{ $registration->phone }}</td>

                    <td class="email">{{ $registration->email }}</td>

                    <td class="date">
                        {{ $registration->created_at->format('d M Y') }}
                    </td>

                    <td>

                        <form method="POST"
                              action="{{ route('admin.registrations.destroy', $registration->id) }}">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Delete this registration?')">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="empty">
                        No registrations found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>