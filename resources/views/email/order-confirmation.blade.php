<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>

<h2>Thank You For Your Order</h2>

<p>Hello {{ $order->name }},</p>

<p>
Your order has been received successfully.
</p>

<p>
Order Status:
<strong>{{ $order->status }}</strong>
</p>

<p>
We will update you once the order is shipped.
</p>

<p>
SV Distribution
</p>

</body>
</html>