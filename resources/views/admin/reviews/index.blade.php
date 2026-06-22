<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Reviews</title>

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
        font-weight: 500;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        padding: 15px;
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
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: top;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .rating {
        font-weight: 600;
        color: #f59e0b;
    }

    .product {
        font-weight: 600;
        color: #4f46e5;
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
    }
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Customer Reviews</h1>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($reviews as $review)

                <tr>

                    <td class="product">
                        {{ $review->product->name }}
                    </td>

                    <td>{{ $review->name }}</td>

                    <td>{{ $review->email }}</td>

                    <td class="rating">
                        {{ $review->rating }}/5 ⭐
                    </td>

                    <td>{{ $review->review }}</td>

                    <td>

                        <form method="POST"
                              action="{{ route('admin.reviews.destroy', $review->id) }}">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Delete this review?')">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="empty">
                        No reviews found.
                    </td>
                </tr>

            @endforelse

            </tbody>
        </table>

    </div>

</div>

</body>
</html>