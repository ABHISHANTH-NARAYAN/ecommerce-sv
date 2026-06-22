<!DOCTYPE html>
<html>
<head>
    <title>Product Enquiry</title>
</head>
<body>

<h2>New Product Enquiry</h2>

<p><strong>Product:</strong> {{ $enquiry->product->name }}</p>

<p><strong>Name:</strong> {{ $enquiry->name }}</p>

<p><strong>Phone:</strong> {{ $enquiry->phone }}</p>

<p><strong>Email:</strong> {{ $enquiry->email }}</p>

<p><strong>Message:</strong></p>

<p>{{ $enquiry->message }}</p>

</body>
</html>