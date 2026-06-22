<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Details</title>

<style>
    body {
        font-family: 'Inter', system-ui, Arial, sans-serif;
        background: #f5f7fb;
        margin: 0;
        padding: 30px;
        color: #111827;
    }

    .container {
        max-width: 1000px;
        margin: auto;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 25px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .image-box {
        background: #f9fafb;
        border-radius: 14px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .image-box img {
        max-width: 100%;
        border-radius: 12px;
    }

    .details h2 {
        margin: 0 0 15px;
        font-size: 28px;
    }

    .price {
        font-size: 22px;
        color: #16a34a;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .badge {
        display: inline-block;
        padding: 5px 10px;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 8px;
        font-size: 13px;
        margin-right: 5px;
    }

    .info {
        margin: 10px 0;
        line-height: 1.6;
    }

    .section-title {
        font-weight: 600;
        margin-top: 15px;
    }

    .colors span {
        display: inline-block;
        background: #f3f4f6;
        padding: 6px 12px;
        margin: 4px;
        border-radius: 20px;
        font-size: 13px;
    }

    .qty-box {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 20px 0;
    }

    .qty-box button {
        padding: 8px 12px;
        border: none;
        background: #111827;
        color: white;
        border-radius: 8px;
        cursor: pointer;
    }

    .qty-box input {
        width: 60px;
        text-align: center;
        padding: 6px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .btn {
        display: inline-block;
        padding: 12px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background: #f59e0b;
        color: #fff;
    }

    .btn-primary:hover {
        background: #d97706;
    }

    .links {
        margin-top: 15px;
    }

    .links a {
        margin-right: 10px;
        color: #4f46e5;
        text-decoration: none;
    }

    @media(max-width: 768px) {
        .card {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body>

<div class="container">

    <div class="card">

        <!-- IMAGE -->
        <div class="image-box">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
            @else
                <p>No Image Available</p>
            @endif
        </div>

        <!-- DETAILS -->
        <div class="details">

            <h2>{{ $product->name }}</h2>

            <div class="price">₹{{ number_format($product->price, 2) }}</div>

            <p class="info">
                <strong>Brand:</strong>
                <span class="badge">{{ $product->brand->name ?? 'No Brand' }}</span>
            </p>

            <p class="info">
                <strong>Status:</strong> {{ $product->status }}
            </p>

            <p class="info">
                <strong>Stock:</strong> {{ $product->stock }}
            </p>

            <p class="info">
                <strong>Description:</strong><br>
                {{ $product->description }}
            </p>

            <div class="section-title">Colors</div>
            <div class="colors">
                @forelse($product->colors as $color)
                    <span>{{ $color->name }}</span>
                @empty
                    <span>No Colors</span>
                @endforelse
            </div>

            <!-- QTY -->
            <div class="qty-box">
                <button type="button" onclick="decreaseQty()">-</button>

                <input type="number" id="qty" value="1" min="1">

                <button type="button" onclick="increaseQty()">+</button>
            </div>

            <!-- ADD TO CART -->
            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <input type="hidden" name="quantity" id="qty_input" value="1">

                <button class="btn btn-primary" type="submit">
                    🛒 Add to Cart
                </button>
            </form>

            <div class="links">
                <a href="{{ route('products.edit', $product->id) }}">Edit Product</a>
                |
                <a href="{{ route('products.index') }}">Back to Products</a>
            </div>

        </div>

    </div>
</div>

<script>
function increaseQty() {
    let qty = document.getElementById('qty');
    qty.value = parseInt(qty.value) + 1;
    syncQty();
}

function decreaseQty() {
    let qty = document.getElementById('qty');
    if (qty.value > 1) qty.value = parseInt(qty.value) - 1;
    syncQty();
}

function syncQty() {
    document.getElementById('qty_input').value =
        document.getElementById('qty').value;
}

document.getElementById('qty').addEventListener('input', syncQty);
</script>

</body>
</html>