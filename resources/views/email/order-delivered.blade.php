<!DOCTYPE html>
<html>
<head>
    <title>Order Delivered</title>
</head>
<body>

<h2>Hello {{ $order->name }},</h2>

<p>Your order #{{ $order->id }} has been successfully delivered.</p>

<p><strong>Total:</strong> ₹{{ number_format($order->total,2) }}</p>

<p>Thank you for shopping with SV Distribution.</p>

</body>
</html>