<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | SV Distribution</title>
    
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
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

        .orb1 { width: 350px; height: 350px; background: #3b82f6; top: 50px; left: -100px; opacity: 0.5; }
        .orb2 { width: 300px; height: 300px; background: #10b981; bottom: 50px; right: -50px; opacity: 0.4; }

        /* =========================================
           CHECKOUT CONTAINER (GLASSMORPHISM)
           ========================================= */
        .checkout-container {
            width: 100%;
            max-width: 650px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 10;
        }

        /* =========================================
           TYPOGRAPHY & LINKS
           ========================================= */
        .back-link { 
            display: inline-block; 
            margin-bottom: 20px; 
            color: #94a3b8; 
            text-decoration: none; 
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-link:hover { 
            color: #ffffff; 
            transform: translateX(-4px);
        }

        h1 { 
            font-size: 36px; 
            font-weight: 800;
            margin-bottom: 10px; 
            background: linear-gradient(90deg, #ffffff, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle { 
            color: #94a3b8; 
            margin-bottom: 30px; 
            font-size: 16px;
        }

        /* =========================================
           FORM ELEMENTS
           ========================================= */
        .input-group { 
            margin-bottom: 20px; 
        }

        label { 
            display: block; 
            font-size: 14px; 
            font-weight: 600; 
            margin-bottom: 8px; 
            color: #cbd5e1; 
            letter-spacing: 0.5px;
        }
        
        input, textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 14px 18px;
            border-radius: 14px;
            color: white;
            font-size: 16px;
            font-family: inherit;
            transition: 0.3s;
            outline: none;
        }

        input:focus, textarea:focus {
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-submit:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
            filter: brightness(1.1);
        }

        /* =========================================
           ERROR MESSAGES
           ========================================= */
        .error-box {
            background: rgba(239, 68, 68, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .error-box ul {
            margin-left: 20px;
            margin-top: 5px;
        }

        /* =========================================
           RESPONSIVE DESIGN
           ========================================= */
        @media(max-width: 600px) {
            .checkout-container {
                padding: 30px 20px;
            }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
            h1 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>

    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>

    <div class="checkout-container">
        
        <a href="{{ route('cart.index') }}" class="back-link">
            ← Return to Cart
        </a>
        
        <h1>Secure Checkout</h1>
        <p class="subtitle">Complete your order details below to finalize your purchase.</p>

        @if($errors->any())
            <div class="error-box">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            
            <div class="form-grid">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                </div>
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+91 00000 00000" required>
            </div>

            <div class="input-group">
                <label>Delivery Address</label>
                <textarea name="address" rows="4" placeholder="Enter your full street address, city, and pin code..." required>{{ old('address') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">🔒 Place Secure Order</button>
        </form>

    </div>

</body>
</html>