<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | SV Distribution</title>

    <style>
        /* =========================================
           RESET & BASE STYLES
           ========================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
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

        .orb1 { width: 350px; height: 350px; background: #3b82f6; top: 100px; left: -100px; opacity: 0.5; }
        .orb2 { width: 300px; height: 300px; background: #10b981; right: -50px; top: 400px; opacity: 0.4; }

        /* =========================================
           HEADER SECTION
           ========================================= */
        .header {
            text-align: center;
            padding: 80px 20px 40px;
        }

        .header h1 {
            font-size: 52px;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(90deg, #ffffff, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 40px rgba(96, 165, 250, 0.3);
            letter-spacing: -1px;
        }

        .header p { color: #94a3b8; font-size: 18px; }

        /* =========================================
           LAYOUT & GRID
           ========================================= */
        .container {
            width: 92%;
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            padding-bottom: 80px;
        }

        /* =========================================
           CART ITEMS
           ========================================= */
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .item {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 20px;
            display: flex;
            gap: 25px;
            align-items: center;
            transition: 0.4s ease;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .item:hover {
            transform: translateY(-5px);
            border-color: rgba(96, 165, 250, 0.4);
            box-shadow: 0 25px 50px rgba(59, 130, 246, 0.15);
            background: rgba(255, 255, 255, 0.05);
        }

        .item img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .item-details { flex: 1; }
        .item-details h3 { margin-bottom: 8px; font-size: 22px; color: #ffffff; line-height: 1.3; }
        .price {
            color: #34d399;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 0 10px rgba(52, 211, 153, 0.3);
        }

        /* =========================================
           CUSTOM QUANTITY & CONTROLS (AUTO-UPDATE)
           ========================================= */
        .controls-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .qty-wrapper {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
            height: 42px; /* Fixed height to match remove button */
        }

        .qty-wrapper:focus-within, .qty-wrapper:hover {
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2);
        }

        .qty-btn {
            background: transparent;
            color: #94a3b8;
            border: none;
            width: 35px;
            height: 100%;
            font-size: 20px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover { background: rgba(59, 130, 246, 0.2); color: #ffffff; }

        .qty-input {
            width: 45px;
            height: 100%;
            background: transparent;
            border: none;
            color: white;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            outline: none;
            padding: 0;
            -moz-appearance: textfield; 
        }

        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove Button */
        .remove-btn {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            height: 42px; /* Matches qty wrapper */
            padding: 0 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: rgba(239, 68, 68, 0.25);
            color: #ffffff;
            border-color: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.2);
        }

        .subtotal {
            text-align: right;
            min-width: 130px;
            padding-left: 20px;
            border-left: 1px solid rgba(255, 255, 255, 0.08);
        }

        .subtotal small { color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-size: 11px; font-weight: 600; }
        .subtotal h3 { color: #34d399; font-size: 24px; margin-top: 5px; }

        form { margin: 0; } /* Reset form margin */

        /* =========================================
           SUMMARY SECTION
           ========================================= */
        .summary {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 26px;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 100px; 
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .summary h2 { font-size: 24px; margin-bottom: 25px; color: #ffffff; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 15px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; color: #d1d5db; font-size: 16px; }
        .total { font-size: 24px; color: #34d399; font-weight: 800; margin-top: 20px; padding-top: 20px; border-top: 1px dashed rgba(255, 255, 255, 0.15); }

        .action-btn {
            display: block;
            text-align: center;
            text-decoration: none;
            color: white;
            padding: 16px;
            border-radius: 16px;
            margin-top: 15px;
            font-weight: 700;
            font-size: 15px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover { transform: translateY(-2px); filter: brightness(1.1); }
        .checkout-btn { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3); margin-top: 25px; }
        
        .home-btn { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .home-btn:hover { background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); }
        
        .clear-btn { background: transparent; color: #ef4444; border: 1px solid transparent; margin-top: 10px; }
        .clear-btn:hover { background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.2); }

        /* =========================================
           EMPTY CART
           ========================================= */
        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            margin: 40px auto;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .empty-cart h2 { font-size: 36px; margin-bottom: 15px; color: #ffffff; }
        .empty-cart p { color: #9ca3af; font-size: 18px; margin-bottom: 35px; }
        
        .back-btn {
            display: inline-block;
            text-decoration: none;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            padding: 14px 32px;
            border-radius: 999px;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
        .back-btn:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4); }

        /* =========================================
           RESPONSIVE DESIGN
           ========================================= */
        @media(max-width: 900px) {
            .container { grid-template-columns: 1fr; }
            .item { flex-direction: column; text-align: center; gap: 15px; }
            .item img { width: 100%; height: 200px; }
            .controls-wrapper { justify-content: center; }
            .subtotal { text-align: center; border-left: none; border-top: 1px solid rgba(255, 255, 255, 0.08); padding-left: 0; padding-top: 15px; width: 100%; }
            .summary { position: relative; top: 0; }
        }
    </style>
</head>
<body>

    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>

    <div class="header">
        <h1>🛒 Your Shopping Cart</h1>
        <p>Review your items before proceeding to checkout.</p>
    </div>

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    @if(count($cart) == 0)
        <div class="empty-cart">
            <h2>Cart is Empty</h2>
            <p>Looks like you haven't added any products yet.</p>
            <a href="{{ route('home') }}" class="back-btn">
                ← Continue Shopping
            </a>
        </div>
    @else
        <div class="container">
            
            <div class="cart-items">
                @foreach($cart as $id => $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="item">
                        @if(!empty($item['image']))
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}">
                        @endif

                        <div class="item-details">
                            <h3>{{ $item['name'] }}</h3>
                            <div class="price">₹{{ number_format($item['price'], 2) }}</div>

                            <div class="controls-wrapper">
                                <form class="qty-form" method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <div class="qty-wrapper">
                                        <button type="button" class="qty-btn minus-btn">−</button>
                                        <input type="number" name="quantity" class="qty-input" value="{{ $item['quantity'] }}" min="1">
                                        <button type="button" class="qty-btn plus-btn">+</button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                    @csrf
                                    <button type="submit" class="remove-btn">
                                        ❌ Remove
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="subtotal">
                            <small>Subtotal</small>
                            <h3>₹{{ number_format($subtotal, 2) }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="summary">
                <h2>📦 Order Summary</h2>

                <div class="summary-row">
                    <span>Total Items</span>
                    <span>{{ count($cart) }}</span>
                </div>

                <div class="summary-row total">
                    <span>Total Amount</span>
                    <span>₹{{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="action-btn checkout-btn">
                    Proceed to Checkout
                </a>

                <a href="{{ route('home') }}" class="action-btn home-btn">
                    Continue Shopping
                </a>

                <a href="{{ route('cart.clear') }}" class="action-btn clear-btn">
                    Clear Cart
                </a>
            </div>

        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add 1 to quantity and submit form
            $('.plus-btn').on('click', function(e) {
                e.preventDefault();
                let $input = $(this).siblings('.qty-input');
                let currentVal = parseInt($input.val());
                if (!isNaN(currentVal)) {
                    $input.val(currentVal + 1);
                    $(this).closest('form').submit(); // Submits instantly
                }
            });

            // Subtract 1 from quantity and submit form
            $('.minus-btn').on('click', function(e) {
                e.preventDefault();
                let $input = $(this).siblings('.qty-input');
                let currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal > 1) { // Prevents going below 1
                    $input.val(currentVal - 1);
                    $(this).closest('form').submit(); // Submits instantly
                }
            });

            // Auto-submit if the user types a number manually
            $('.qty-input').on('change', function() {
                let currentVal = parseInt($(this).val());
                if (isNaN(currentVal) || currentVal < 1) {
                    $(this).val(1); // Default back to 1 if they type gibberish or 0
                }
                $(this).closest('form').submit();
            });
        });
    </script>
</body>
</html>