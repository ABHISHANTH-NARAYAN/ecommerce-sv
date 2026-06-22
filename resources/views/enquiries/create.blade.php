<!DOCTYPE html>

<html>
<head>
    <title>Product Enquiry</title>

```
<style>
    body{
        font-family: Arial, sans-serif;
        background:#f5f5f5;
        margin:0;
        padding:40px;
    }

    .container{
        max-width:700px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:10px;
        box-shadow:0 2px 5px rgba(0,0,0,0.1);
    }

    h2{
        margin-bottom:20px;
    }

    label{
        font-weight:bold;
    }

    input,
    textarea{
        width:100%;
        padding:10px;
        margin-top:5px;
        margin-bottom:15px;
        border:1px solid #ccc;
        border-radius:5px;
        box-sizing:border-box;
    }

    button{
        background:#16a34a;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:5px;
        cursor:pointer;
    }

    button:hover{
        opacity:0.9;
    }

    .error{
        color:red;
        margin-bottom:15px;
    }

    .back-link{
        display:inline-block;
        margin-top:20px;
        text-decoration:none;
    }
</style>
```

</head>
<body>

<div class="container">

```
<h2>Enquiry for {{ $product->name }}</h2>

@if($errors->any())
    <div class="error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('enquiries.store', $product->id) }}">

    @csrf

    <label>Name</label>
    <input type="text"
           name="name"
           value="{{ old('name') }}"
           required>

    <label>Phone</label>
    <input type="text"
           name="phone"
           value="{{ old('phone') }}"
           required>

    <label>Email</label>
    <input type="email"
           name="email"
           value="{{ old('email') }}"
           required>

    <label>Message</label>
    <textarea name="message"
              rows="5"
              required>{{ old('message') }}</textarea>

    <button type="submit">
        Submit Enquiry
    </button>

</form>

<a href="{{ route('home') }}" class="back-link">
    ← Back to Products
</a>
```

</div>

</body>
</html>
