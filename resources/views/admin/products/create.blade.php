<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>

    <style>
        body{
            font-family: Arial;
            background:#f3f4f6;
            margin:0;
        }

        .container{
            width:60%;
            margin:auto;
            background:white;
            padding:25px;
            margin-top:30px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        h2{
            text-align:center;
        }

        label{
            font-weight:bold;
            display:block;
            margin-top:10px;
        }

        input, select, textarea{
            width:100%;
            padding:10px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:6px;
        }

        textarea{
            resize:none;
        }

        .row{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:15px;
        }

        .btn{
            width:100%;
            padding:12px;
            margin-top:15px;
            background:#16a34a;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }

        .back{
            display:block;
            text-align:center;
            margin-top:15px;
            text-decoration:none;
            color:#2563eb;
        }

        .error{
            color:red;
            font-size:13px;
        }

        .colors{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
        }

        .colors label{
            font-weight:normal;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Create Product</h2>

    @if(session('success'))
        <p style="color:green;text-align:center;">
            {{ session('success') }}
        </p>
    @endif

    <form action="{{ route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- BRAND -->
        <label>Brand</label>
        <select name="brand_id">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
        <div class="error">@error('brand_id') {{ $message }} @enderror</div>

        <!-- PRODUCT NAME -->
        <label>Product Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        <div class="error">@error('name') {{ $message }} @enderror</div>

        <!-- PRICE (IMPORTANT FIX ADDED) -->
        <label>Price (₹)</label>
        <input type="number" name="price" value="{{ old('price') }}" step="0.01">
        <div class="error">@error('price') {{ $message }} @enderror</div>

        <div class="row">

            <!-- STOCK -->
            <div>
                <label>Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}">
                <div class="error">@error('stock') {{ $message }} @enderror</div>
            </div>

            <!-- STATUS -->
            <div>
                <label>Status</label>
                <select name="status">
                    <option value="">Select</option>
                    <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
                <div class="error">@error('status') {{ $message }} @enderror</div>
            </div>

        </div>

        <!-- FEATURED -->
        <label>Featured Product</label>
        <select name="featured">
            <option value="0" {{ old('featured') == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('featured') == 1 ? 'selected' : '' }}>Yes</option>
        </select>

        <!-- DESCRIPTION -->
        <label>Description</label>
        <textarea name="description" rows="4">{{ old('description') }}</textarea>
        <div class="error">@error('description') {{ $message }} @enderror</div>

        <!-- COLORS -->
        <label>Colors</label>
        <div class="colors">
            @foreach($colors as $color)
                <label>
                    <input type="checkbox"
                           name="colors[]"
                           value="{{ $color->id }}"
                           {{ in_array($color->id, old('colors', [])) ? 'checked' : '' }}>
                    {{ $color->name }}
                </label>
            @endforeach
        </div>

        <!-- IMAGE -->
        <label>Product Image</label>
        <input type="file" name="image">
        <div class="error">@error('image') {{ $message }} @enderror</div>

        <!-- SUBMIT -->
        <button type="submit" class="btn">
            Save Product
        </button>

    </form>

    <a href="{{ route('admin.products.index') }}" class="back">
        ← Back to Products
    </a>

</div>

</body>
</html>