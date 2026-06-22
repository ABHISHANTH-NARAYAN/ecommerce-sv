<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Orders</title>

<style>
body{
    margin:0;
    font-family:system-ui,Arial,sans-serif;
    background:#f4f6fb;
    color:#111827;
}

.container{
    max-width:1200px;
    margin:auto;
    padding:25px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

h2{
    margin:0;
    font-size:28px;
}

.card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#111827;
    color:#fff;
}

th,td{
    padding:15px;
    border-bottom:1px solid #e5e7eb;
    text-align:left;
}

tbody tr:hover{
    background:#f9fafb;
}

.view-btn{
    text-decoration:none;
    background:#4f46e5;
    color:white;
    padding:8px 12px;
    border-radius:8px;
    font-size:13px;
}

.view-btn:hover{
    opacity:.9;
}

.status-select{
    border:none;
    padding:8px 12px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

.pending{
    background:#fef3c7;
    color:#92400e;
}

.delivered{
    background:#dcfce7;
    color:#166534;
}

.cancelled{
    background:#fee2e2;
    color:#991b1b;
}

.empty{
    text-align:center;
    padding:30px;
    color:#6b7280;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
}

@media(max-width:768px){
    table{
        display:block;
        overflow-x:auto;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>📦 Orders Management</h2>
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
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>

            @forelse($orders as $order)

                <tr>

                    <td>#{{ $order->id }}</td>
<td>{{ $order->name }}</td>
<td>{{ $order->email }}</td>
<td>{{ $order->phone }}</td>
<td>₹{{ number_format($order->total,2) }}</td>
                    <td>

                        <form method="POST"
                              action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="status-select
                                    @if($order->status=='Pending') pending
                                    @elseif($order->status=='Delivered') delivered
                                    @elseif($order->status=='Cancelled') cancelled
                                    @endif">

                                <option value="Pending"
                                    {{ $order->status=='Pending' ? 'selected' : '' }}>
                                    🟡 Pending
                                </option>

                                <option value="Delivered"
                                    {{ $order->status=='Delivered' ? 'selected' : '' }}>
                                    🟢 Delivered
                                </option>

                                <option value="Cancelled"
                                    {{ $order->status=='Cancelled' ? 'selected' : '' }}>
                                    🔴 Cancelled
                                </option>

                            </select>

                        </form>

                    </td>

                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="view-btn">
                            View
                        </a>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="empty">
                        No Orders Found
                    </td>
                </tr>

            @endforelse

            </tbody>
        </table>

    </div>

</div>

</body>
</html>