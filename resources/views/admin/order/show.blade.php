<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>

<style>
body{
    font-family:Arial;
    background:#f5f5f5;
    margin:0;
    padding:20px;
}

.container{
    max-width:1000px;
    margin:auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    padding:12px;
    border-bottom:1px solid #eee;
}

th{
    background:#1f2937;
    color:white;
}

.badge{
    padding:5px 10px;
    border-radius:5px;
    color:white;
}

.pending{background:#f59e0b;}
.completed{background:#16a34a;}
.cancelled{background:#ef4444;}

a{
    text-decoration:none;
    color:#2563eb;
}
</style>

</head>
<body>

<div class="container">

<h2>🧾 Order #{{ $order->id }}</h2>

<!-- CUSTOMER INFO -->
<div class="card">
    <h3>Customer Details</h3>
    <p><strong>Name:</strong> {{ $order->name }}</p>
<p><strong>Email:</strong> {{ $order->email }}</p>
<p><strong>Phone:</strong> {{ $order->phone }}</p>
<p><strong>Address:</strong> {{ $order->address }}</p>
        <span class="badge {{ strtolower($order->status) }}">
            {{ $order->status }}
        </span>
    </p>
    <p><b>Date:</b> {{ $order->created_at->format('d M Y H:i') }}</p>
</div>

<!-- ITEMS -->
<div class="card">
    <h3>Order Items</h3>

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>

        @php $grandTotal = 0; @endphp

        @foreach($order->items as $item)

            @php
                $total = $item->price * $item->quantity;
                $grandTotal += $total;
            @endphp

            <tr>
                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                <td>₹{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ $total }}</td>
            </tr>

        @endforeach

        <tr>
            <td colspan="3"><b>Grand Total</b></td>
            <td><b>₹{{ $grandTotal }}</b></td>
        </tr>

    </table>
</div>

<a href="{{ route('admin.orders.index') }}">← Back to Orders</a>

</div>

</body>
</html>