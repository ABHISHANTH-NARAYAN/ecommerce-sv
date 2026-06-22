<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

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
            background:#2563eb;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }

        .cancel{
            display:block;
            text-align:center;
            margin-top:10px;
            color:#ef4444;
            text-decoration:none;
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

        img.preview{
            width:150px;
            border-radius:8px;
            margin-top:10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Edit Product</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- BRAND -->
        <label>Brand</label>
        <select name="brand_id">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                    {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>

        <!-- PRODUCT NAME -->
        <label>Product Name</label>
        <input type="text" name="name"
               value="{{ old('name', $product->name) }}">

        <!-- PRICE (IMPORTANT FIX) -->
        <label>Price (₹)</label>
        <input type="number" step="0.01" name="price"
               value="{{ old('price', $product->price) }}">

        <div class="row">

            <!-- STOCK -->
            <div>
                <label>Stock</label>
                <input type="number" name="stock"
                       value="{{ old('stock', $product->stock) }}">
            </div>

            <!-- STATUS -->
            <div>
                <label>Status</label>
                <select name="status">
                    <option value="Available"
                        {{ old('status', $product->status) == 'Available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="Out of Stock"
                        {{ old('status', $product->status) == 'Out of Stock' ? 'selected' : '' }}>
                        Out of Stock
                    </option>
                </select>
            </div>

        </div>

        <!-- FEATURED -->
        <label>Featured Product</label>
        <select name="featured">
            <option value="0" {{ old('featured', $product->featured) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('featured', $product->featured) == 1 ? 'selected' : '' }}>Yes</option>
        </select>

        <!-- DESCRIPTION -->
        <label>Description</label>
        <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>

        <!-- COLORS -->
        <label>Colors</label>
        <div class="colors">
            @foreach($colors as $color)
                <label>
                    <input type="checkbox"
                           name="colors[]"
                           value="{{ $color->id }}"
                           {{ $product->colors->contains($color->id) ? 'checked' : '' }}>
                    {{ $color->name }}
                </label>
            @endforeach
        </div>

        <!-- CURRENT IMAGE -->
        <label>Current Image</label>

        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="preview">
        @else
            <p>No Image Available</p>
        @endif

        <!-- NEW IMAGE -->
        <label>Change Image</label>
        <input type="file" name="image">

        <!-- SUBMIT -->
        <button type="submit" class="btn">
            Update Product
        </button>

    </form>

    <a href="{{ route('products.index') }}" class="cancel">
        ← Cancel
    </a>

</div>

</body>
</html>