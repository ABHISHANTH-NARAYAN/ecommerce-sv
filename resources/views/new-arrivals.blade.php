<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Arrivals | SV Distribution</title>
    <style>
        /* =========================================
           RESET & BASE STYLES
           ========================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", sans-serif;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 122, 255, 0.18), transparent 35%),
                radial-gradient(circle at 80% 30%, rgba(52, 199, 89, 0.15), transparent 35%),
                radial-gradient(circle at 50% 90%, rgba(175, 82, 222, 0.18), transparent 40%),
                #050816;
            color: white;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            backdrop-filter: blur(120px);
            z-index: -1;
        }

        /* =========================================
           SCROLL REVEAL ANIMATIONS
           ========================================= */
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
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

        .orb1 { width: 300px; height: 300px; background: #0ea5e9; top: 100px; left: -100px; }
        .orb2 { width: 350px; height: 350px; background: #a855f7; right: -100px; top: 300px; }

        /* =========================================
           NAVIGATION
           ========================================= */
        .nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            max-width: 1400px;
            padding: 14px 24px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(90deg, #fff, #7dd3fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 10px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 12px;
            transition: 0.35s;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 500;
        }

        .nav a:hover, .nav a.active {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-search {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            padding: 5px 15px;
            transition: 0.3s;
        }

        .nav-search:focus-within {
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2);
        }

        .nav-search input {
            background: transparent;
            border: none;
            color: white;
            padding: 8px;
            outline: none;
            width: 150px;
        }
        
        .nav-search input::placeholder { color: #9ca3af; }

        .cart-badge {
            background: #ff375f;
            color: white;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: bold;
        }

        /* =========================================
           HERO BANNER
           ========================================= */
        .banner {
            padding: 160px 20px 60px;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: auto;
        }

        .new-label {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(168, 85, 247, 0.2);
            border: 1px solid rgba(168, 85, 247, 0.5);
            color: #d8b4fe;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hero-content h1 {
            font-size: 64px;
            line-height: 1.1;
            font-weight: 900;
            background: linear-gradient(90deg, #ffffff, #c084fc, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .hero-content p {
            color: #94a3b8;
            font-size: 20px;
            line-height: 1.6;
        }

        /* =========================================
           PRODUCTS GRID & CARDS
           ========================================= */
        .products {
            width: 92%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            flex-grow: 1; /* Pushes footer to bottom if few products */
        }

        .product-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 20px;
            overflow: hidden;
            transition: 0.4s;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(192, 132, 252, 0.5);
            box-shadow: 0 40px 90px rgba(168, 85, 247, 0.15);
            background: rgba(255, 255, 255, 0.06);
        }

        .product-card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 24px;
            transition: 0.5s;
        }

        .product-card:hover img { transform: scale(1.04); }

        /* "NEW DROP" Badge */
        .new-drop-badge {
            position: absolute;
            top: 35px;
            right: 35px;
            background: linear-gradient(90deg, #a855f7, #ec4899);
            color: white;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(236, 72, 153, 0.4);
            z-index: 10;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(236, 72, 153, 0); }
            100% { box-shadow: 0 0 0 0 rgba(236, 72, 153, 0); }
        }

        .product-card h3 {
            margin-top: 20px;
            font-size: 22px;
            color: #ffffff;
        }

        .price {
            color: #34d399;
            font-size: 26px;
            font-weight: 700;
            margin: 10px 0;
            text-shadow: 0 0 10px rgba(52, 211, 153, 0.3);
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 10px;
            padding: 14px;
            border-radius: 16px;
            text-decoration: none;
            color: white;
            font-weight: 700;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 15px;
        }

        .btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 30px;
            border: 1px dashed rgba(255, 255, 255, 0.1);
        }
        
        .empty-state h3 { font-size: 28px; margin-bottom: 10px; }
        .empty-state p { color: #94a3b8; }

        /* =========================================
           MEGA FOOTER (Copied from Home)
           ========================================= */
        .mega-footer {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(30px);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 80px 20px 40px;
            margin-top: auto;
        }

        .footer-grid {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            gap: 40px;
        }

        .footer-col h3 { font-size: 20px; margin-bottom: 20px; color: #ffffff; }
        .footer-col p { color: #94a3b8; line-height: 1.6; margin-bottom: 15px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul a { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .footer-col ul a:hover { color: #3b82f6; padding-left: 5px; }

        .footer-newsletter input {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            margin-bottom: 10px;
            outline: none;
        }
        .footer-newsletter input:focus { border-color: #34d399; }
        .footer-newsletter button {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #0ea5e9, #34d399);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .footer-newsletter button:hover { transform: translateY(-2px); }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #64748b;
            font-size: 14px;
        }

        /* =========================================
           TOAST NOTIFICATION
           ========================================= */
        #toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: rgba(34, 197, 94, 0.95);
            color: white;
            padding: 16px 24px;
            border-radius: 18px;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.4);
            display: none;
            z-index: 1000;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media(max-width: 900px) {
            .nav { flex-direction: column; gap: 15px; padding: 20px; border-radius: 20px; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media(max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 48px; }
        }
    </style>
</head>

<body>
    <!-- Background Effects -->
    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>

    <!-- Navigation -->
    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-brand">SV.</a>
        
        <div class="nav-links">
            <a href="{{ route('home') }}">Products</a>
            <a href="#" class="active">New Arrivals</a>
            <a href="{{ route('frontend.news') }}">News</a>
            <a href="{{ route('wishlist.index') }}">
                ❤️ Wishlist <span class="cart-badge">{{ count(session('wishlist', [])) }}</span>
            </a>
            <a href="{{ route('cart.index') }}">
                🛒 Cart <span class="cart-badge">{{ count(session('cart', [])) }}</span>
            </a>
        </div>

        <div class="nav-search">
            <input type="text" placeholder="Search products...">
            <span style="cursor: pointer;">🔍</span>
        </div>
    </nav>

    <!-- Hero Banner -->
    <div class="banner fade-up">
        <div class="hero-content">
            <span class="new-label">Just Dropped</span>
            <h1>New Arrivals</h1>
            <p>Discover our latest premium tech, accessories, and gear. Be the first to experience the future of distribution.</p>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="products">
        @forelse($products as $product)
            <div class="product-card fade-up">
                
                <span class="new-drop-badge">NEW</span>

                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @endif

                <h3>{{ $product->name }}</h3>
                <div class="price">₹{{ number_format($product->price, 2) }}</div>

                <p style="color:#9ca3af; font-size:14px; margin-bottom: 15px; flex-grow: 1;">
                    {{ Str::limit($product->description, 80) }}
                </p>

                <p style="margin-bottom: 15px; color:#cbd5e1;"><b>Stock:</b> {{ $product->stock }} Units Available</p>

                <!-- Add to Cart -->
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button type="submit" class="btn" style="background: linear-gradient(135deg, #a855f7, #6366f1);">
                        🛒 Add to Cart
                    </button>
                </form>

                <!-- Contact/Enquiry Options -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">
                    <a href="{{ route('enquiries.create', $product->id) }}" class="btn" style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e;">Enquire</a>
                    <a href="https://wa.me/918075929967?text=Hi%20I%20am%20interested%20in%20your%20new%20arrival:%20{{ urlencode($product->name) }}" class="btn" style="background: #25D366;">WhatsApp</a>
                </div>

                <!-- Wishlist -->
                <button class="btn wishlist-btn" data-id="{{ $product->id }}" style="background: transparent; border: 1px solid rgba(239, 68, 68, 0.5); color: #fca5a5; margin-top: 15px;">
                    ❤️ Add to Wishlist
                </button>
            </div>
        @empty
            <div class="empty-state fade-up">
                <h3>No New Arrivals Right Now</h3>
                <p>We are currently restocking our latest drops. Please check back soon!</p>
            </div>
        @endforelse
    </div>

    <!-- Mega Footer -->
    <footer class="mega-footer">
        <div class="footer-grid fade-up">
            <div class="footer-col">
                <h3 style="font-size: 28px; background: linear-gradient(90deg, #fff, #7dd3fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">SV.</h3>
                <p>Bringing the future of distribution to your doorstep. Premium products, seamless logistics, and unparalleled customer service.</p>
                <p>📍 PV Sami Road, Chalappuram</p>
                <p>📞 +91 80759 29967</p>
                <p>✉️ abhishanth.narayan@gmail.com</p>
            </div>
            
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Shop All</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="{{ route('cart.index') }}">Your Cart</a></li>
                    <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Return Policy</a></li>
                </ul>
            </div>

            <div class="footer-col footer-newsletter">
                <h3>Get Exclusive Offers</h3>
                <p>Subscribe to our newsletter for early access to sales and new product launches.</p>
                <form onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Email Address" required>
                    <button type="submit">Subscribe Now</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 SV Distribution. All rights reserved.</p>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast">Added to wishlist ❤️</div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Wishlist AJAX
        $(document).on('click', '.wishlist-btn', function (e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.post("/wishlist/add/" + id, {
                _token: "{{ csrf_token() }}"
            }, function () {
                $('#toast').fadeIn();
                setTimeout(function(){
                    $('#toast').fadeOut();
                }, 3000);
            });
        });

        // Scroll Reveal Animation Observer
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-up').forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html>