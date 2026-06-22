<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist | SV Distribution</title>

    <style>
        /* =========================================
           RESET & BASE STYLES
           ========================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", sans-serif;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 122, 255, 0.18), transparent 35%),
                radial-gradient(circle at 80% 30%, rgba(52, 199, 89, 0.15), transparent 35%),
                radial-gradient(circle at 50% 90%, rgba(175, 82, 222, 0.18), transparent 40%),
                #050816;
            color: #e5e7eb;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            backdrop-filter: blur(120px);
            z-index: -1;
        }

        /* =========================================
           BACKGROUND EFFECTS
           ========================================= */
        .aurora {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.25), transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.20), transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(168, 85, 247, 0.20), transparent 40%);
            animation: floatAurora 12s infinite alternate ease-in-out;
        }

        @keyframes floatAurora {
            from { transform: translateY(-20px); }
            to { transform: translateY(20px); }
        }

        .floating-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
        }

        .orb1 { width: 300px; height: 300px; background: #ef4444; top: 100px; left: -100px; opacity: 0.5; }
        .orb2 { width: 350px; height: 350px; background: #3b82f6; right: -100px; top: 300px; opacity: 0.5; }

        /* =========================================
           HEADER SECTION
           ========================================= */
        .header {
            text-align: center;
            padding: 80px 20px 40px;
        }

        .header h1 {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(90deg, #ffffff, #fca5a5, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 40px rgba(239, 68, 68, 0.3);
            letter-spacing: -1px;
        }

        .header-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .nav-btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 999px;
            backdrop-filter: blur(20px);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .home-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .home-btn:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.2);
        }

        .top-cart-btn {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.1);
        }

        .top-cart-btn:hover {
            transform: translateY(-3px);
            background: rgba(245, 158, 11, 0.25);
            border-color: rgba(245, 158, 11, 0.5);
            box-shadow: 0 15px 40px rgba(245, 158, 11, 0.3);
        }

        /* =========================================
           SUCCESS BANNER
           ========================================= */
        .success-banner {
            background: rgba(34, 197, 94, 0.15);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
            padding: 16px 24px;
            margin: 0 auto 30px;
            width: 90%;
            max-width: 600px;
            border-radius: 16px;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.15);
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* =========================================
           WISHLIST GRID
           ========================================= */
        .container {
            width: 92%;
            max-width: 1200px;
            margin: auto;
            padding-bottom: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        /* =========================================
           PRODUCT CARD (GLASSMORPHISM)
           ========================================= */
        .card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 26px;
            padding: 20px;
            transition: 0.4s ease;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(239, 68, 68, 0.4);
            box-shadow: 0 30px 60px rgba(239, 68, 68, 0.15);
            background: rgba(255, 255, 255, 0.05);
        }

        /* Image Wrapper */
        .img-wrapper {
            width: 100%;
            height: 220px;
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s ease;
        }

        .card:hover img {
            transform: scale(1.06);
        }

        .card h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #ffffff;
            line-height: 1.3;
        }

        .price {
            color: #34d399;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(52, 211, 153, 0.4);
        }

        /* =========================================
           BUTTONS
           ========================================= */
        .btn-wrapper {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            text-align: center;
            border-radius: 16px;
            border: none;
            text-decoration: none;
            color: white;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .cart {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.2);
        }

        .remove {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            backdrop-filter: blur(10px);
        }

        .btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }
        
        .cart:hover {
            box-shadow: 0 12px 25px rgba(245, 158, 11, 0.4);
        }

        .remove:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #ffffff;
            border-color: #ef4444;
        }

        form {
            margin: 0;
            width: 100%;
        }

        /* =========================================
           EMPTY STATE
           ========================================= */
        .empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            margin: 40px auto;
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
        }

        .empty p {
            color: #94a3b8;
            font-size: 18px;
        }
        
        /* =========================================
           RESPONSIVE DESIGN
           ========================================= */
        @media(max-width: 768px) {
            .header h1 {
                font-size: 42px;
            }
            .container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- Background Elements -->
    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>

    <!-- Header Section -->
    <div class="header">
        <h1>Your Wishlist ❤️</h1>
        <div class="header-actions">
            <a href="{{ route('home') }}" class="nav-btn home-btn">
                🏠 Back to Home
            </a>
            <!-- NEW GO TO CART BUTTON -->
            <a href="{{ route('cart.index') }}" class="nav-btn top-cart-btn">
                🛒 Go to Cart
            </a>
        </div>
    </div>

    <!-- Success Message Banner -->
    @if(session('success'))
        <div class="success-banner">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Wishlist Grid -->
    <div class="container">
        @forelse($wishlist as $product)
            <div class="card">
                
                @if(!empty($product['image']))
                    <div class="img-wrapper">
                        <img src="{{ asset('storage/'.$product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                @endif

                <h3>{{ $product['name'] }}</h3>
                <div class="price">₹{{ number_format($product['price'], 2) }}</div>

                <div class="btn-wrapper">
                    <!-- Move to Cart Form -->
                    <form method="POST" action="{{ route('wishlist.moveToCart', $product['id']) }}">
                        @csrf
                        <button class="btn cart" type="submit">
                            🛒 Move to Cart
                        </button>
                    </form>

                    <!-- Remove Form -->
                    <form method="POST" action="{{ route('wishlist.remove', $product['id']) }}">
                        @csrf
                        <button type="submit" class="btn remove">
                            ❌ Remove
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="empty">
                <p>No items in your wishlist yet 💔</p>
            </div>
        @endforelse
    </div>

</body>
</html>