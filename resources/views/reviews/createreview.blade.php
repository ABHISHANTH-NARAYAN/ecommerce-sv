<!DOCTYPE html>
<html>
<head>
    <title>Add Review</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            margin:0;
            padding:40px;
        }

        .container{
            max-width:600px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:5px;
            box-sizing:border-box;
        }

        button{
            background:#2563eb;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#1d4ed8;
        }

        .error{
            color:red;
            margin-bottom:15px;
        }

        .success{
            color:green;
            margin-bottom:15px;
        }

        .back-btn{
            display:inline-block;
            margin-top:15px;
            text-decoration:none;
            color:#2563eb;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Review for {{ $product->name }}</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

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
          action="{{ route('reviews.store', $product->id) }}">

        @csrf

        <label>Name</label>
        <input type="text"
               name="name"
               value="{{ old('name') }}"
               required>

        <label>Email</label>
        <input type="email"
               name="email"
               value="{{ old('email') }}"
               required>

        <label>Rating</label>
        <select name="rating" required>
            <option value="">Select Rating</option>
            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
            <option value="4">⭐⭐⭐⭐ (4)</option>
            <option value="3">⭐⭐⭐ (3)</option>
            <option value="2">⭐⭐ (2)</option>
            <option value="1">⭐ (1)</option>
        </select>

        <label>Review</label>
        <textarea name="review"
                  rows="5"
                  required>{{ old('review') }}</textarea>

        <button type="submit">
            Submit Review
        </button>

    </form>

    <br>

    <a href="{{ route('home') }}" class="back-btn">
        ← Back to Products
    </a>

</div>

</body>
</html>
