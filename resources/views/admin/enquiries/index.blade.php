<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Enquiries</title>

<style>
    body {
        margin: 0;
        font-family: system-ui, Arial, sans-serif;
        background: #f4f6fb;
        color: #111827;
    }

    .container {
        max-width: 1200px;
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
        font-weight: 500;
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
        vertical-align: top;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .product {
        font-weight: 600;
        color: #4f46e5;
    }

    .message {
        max-width: 300px;
        color: #374151;
        line-height: 1.4;
    }

    .date {
        font-size: 13px;
        color: #6b7280;
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

    .empty {
        text-align: center;
        padding: 20px;
        color: #6b7280;
    }

    @media(max-width: 768px) {
        th, td {
            font-size: 13px;
        }

        .message {
            max-width: 180px;
        }
    }
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>Customer Enquiries</h1>
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
                    <th>Product</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($enquiries as $enquiry)

                <tr>

                    <td class="product">
                        {{ $enquiry->product->name }}
                    </td>

                    <td>{{ $enquiry->name }}</td>

                    <td>{{ $enquiry->phone }}</td>

                    <td>{{ $enquiry->email }}</td>

                    <td class="message">
                        {{ $enquiry->message }}
                    </td>

                    <td class="date">
                        {{ $enquiry->created_at->format('d M Y') }}
                    </td>

                    <td>

                        <form method="POST"
                              action="{{ route('admin.enquiries.destroy', $enquiry->id) }}">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Delete this enquiry?')">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="empty">
                        No enquiries found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>