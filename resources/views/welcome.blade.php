<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SV Distribution | Premium Products</title>
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
        .orb2 { width: 350px; height: 350px; background: #34d399; right: -100px; top: 300px; }
        .orb3 { width: 250px; height: 250px; background: #a855f7; bottom: 50px; left: 40%; }

        /* =========================================
           UPGRADED NAVIGATION
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

        .nav a:hover {
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
           HEADER & HERO
           ========================================= */
        .banner {
            padding: 180px 20px 80px;
            text-align: center;
        }

        .hero-content {
            max-width: 900px;
            margin: auto;
        }

        .hero-content h2 {
            font-size: 72px;
            line-height: 1.05;
            font-weight: 900;
            background: linear-gradient(90deg, #ffffff, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .hero-content p {
            color: #94a3b8;
            font-size: 20px;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .hero-btn {
            display: inline-block;
            padding: 16px 32px;
            border-radius: 999px;
            text-decoration: none;
            margin: 6px;
            font-weight: 700;
            transition: 0.4s;
        }

        .primary-btn {
            background: linear-gradient(135deg, #0ea5e9, #34d399);
            color: white;
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3);
        }

        .secondary-btn {
            color: white;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
        }

        /* =========================================
           TRUSTED BRANDS BANNER
           ========================================= */
        .trusted-brands {
            text-align: center;
            padding: 40px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(0, 0, 0, 0.2);
            margin-bottom: 60px;
        }

        .trusted-brands p {
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        .brand-logos {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
            opacity: 0.6;
        }

        .brand-logos span {
            font-size: 24px;
            font-weight: 800;
            color: #94a3b8;
            letter-spacing: -1px;
        }

        /* =========================================
           STATS SECTION
           ========================================= */
        .stats {
            width: 92%;
            max-width: 1200px;
            margin: 0 auto 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .stat-card {
            text-align: center;
            padding: 30px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12), 0 20px 40px rgba(0, 0, 0, 0.25);
            transition: 0.4s;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: translateY(-10px);
            border-color: rgba(52, 211, 153, 0.3);
        }

        .stat-card h3 {
            font-size: 42px;
            color: #34d399;
            margin-bottom: 5px;
        }

        /* =========================================
           CATEGORY FILTERS
           ========================================= */
        .filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 40px auto;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 10px 24px;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
            backdrop-filter: blur(10px);
        }

        .filter-btn:hover, .filter-btn.active {
            background: rgba(59, 130, 246, 0.2);
            border-color: #3b82f6;
            color: #60a5fa;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
        }

        /* =========================================
           PRODUCTS GRID
           ========================================= */
        .products {
            width: 92%;
            max-width: 1200px;
            margin: auto;
            padding: 40px 0 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
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
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(125, 211, 252, 0.5);
            box-shadow: 0 40px 90px rgba(14, 165, 233, 0.18);
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

        .product-card h3 {
            margin-top: 20px;
            font-size: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .price {
            color: #34d399;
            font-size: 26px;
            font-weight: 700;
            margin: 10px 0;
            text-shadow: 0 0 10px rgba(52, 211, 153, 0.5);
        }

        .featured {
            background: #f59e0b;
            color: black;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: bold;
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

        /* =========================================
           TESTIMONIALS SECTION
           ========================================= */
        .testimonials {
            padding: 80px 20px;
            text-align: center;
            max-width: 1200px;
            margin: auto;
        }

        .testimonials h2 {
            font-size: 40px;
            margin-bottom: 40px;
            background: linear-gradient(90deg, #fff, #a855f7, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .test-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .test-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 30px;
            border-radius: 24px;
            text-align: left;
            transition: 0.3s;
        }

        .test-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(168, 85, 247, 0.4);
        }

        .test-card .stars { color: #f59e0b; margin-bottom: 15px; font-size: 18px; }
        .test-card p { color: #cbd5e1; font-style: italic; line-height: 1.6; margin-bottom: 20px; }
        .test-card h4 { color: white; font-size: 16px; }

        /* =========================================
           MEGA FOOTER
           ========================================= */
        .mega-footer {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(30px);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 80px 20px 40px;
            margin-top: 60px;
        }

        .footer-grid {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            gap: 40px;
        }

        .footer-col h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .footer-col p {
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul a {
            color: #94a3b8;
            text-decoration: none;
            transition: 0.3s;
        }
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
            .hero-content h2 { font-size: 48px; }
        }
    </style>
</head>

<body>
    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>
    <div class="floating-orb orb3"></div>

    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-brand">SV.</a>
        
        <div class="nav-links">
            <a href="{{ route('home') }}">Products</a>
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

    <div class="banner fade-up">
        <div class="hero-content">
            <h2>Experience The Future Of Distribution</h2>
            <p>Premium products. Intelligent logistics. Fast delivery powered by technology.</p>
            
            <div class="hero-buttons">
                <a href="#products" class="hero-btn primary-btn">Shop Collection</a>
                <a href="{{ route('frontend.news') }}" class="hero-btn secondary-btn">Latest News</a>
            </div>
        </div>
    </div>

    <div class="trusted-brands fade-up">
        <p>TRUSTED BY INNOVATIVE BRANDS</p>
        <div class="brand-logos">
            <span>TECHCORP</span>
            <span>NEXUS</span>
            <span>AERODYNAMICS</span>
            <span>QUANTUM</span>
            <span>STELLAR</span>
        </div>
    </div>

    <div class="stats fade-up">
        <div class="stat-card">
            <h3>{{ $products->count() }}</h3>
            <p>Premium Products</p>
        </div>
        <div class="stat-card">
            <h3>1000+</h3>
            <p>Orders Delivered</p>
        </div>
        <div class="stat-card">
            <h3>4.9★</h3>
            <p>Customer Rating</p>
        </div>
        <div class="stat-card">
            <h3>24/7</h3>
            <p>Expert Support</p>
        </div>
    </div>

    <div class="filters fade-up" id="products">
        <button class="filter-btn active">All Products</button>
        <button class="filter-btn">New Arrivals</button>
        <button class="filter-btn">Electronics</button>
        <button class="filter-btn">Accessories</button>
    </div>

    <div class="products">
        @foreach($products as $product)
            <div class="product-card fade-up">
                
                <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @endif
                </a>

                <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                    <h3>
                        {{ $product->name }}
                        @if($product->featured)
                            <span class="featured">FEATURED</span>
                        @endif
                    </h3>
                </a>

                <div class="price">₹{{ number_format($product->price, 2) }}</div>

                <p style="color:#9ca3af; font-size:14px; margin-bottom: 15px; flex-grow: 1;">
                    {{ Str::limit($product->description, 80) }}
                </p>

                <p style="margin-bottom: 5px; color:#f59e0b;">★ {{ number_format($product->reviews->avg('rating'), 1) }}/5</p>
                <p style="margin-bottom: 15px; color:#cbd5e1;"><b>Stock:</b> {{ $product->stock }}</p>

                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button type="submit" class="btn" style="background: linear-gradient(90deg, #f59e0b, #f97316);">
                        🛒 Add to Cart
                    </button>
                </form>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">
                    <a href="{{ route('enquiries.create', $product->id) }}" class="btn" style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e;">Enquire</a>
                    <a href="https://wa.me/918075929967?text=Hi%20I%20am%20interested%20in%20{{ urlencode($product->name) }}" class="btn" style="background: #25D366;">WhatsApp</a>
                </div>

                <button class="btn wishlist-btn" data-id="{{ $product->id }}" style="background: transparent; border: 1px solid rgba(239, 68, 68, 0.5); color: #fca5a5; margin-top: 15px;">
                    ❤️ Add to Wishlist
                </button>
            </div>
        @endforeach
    </div>

    <div class="testimonials fade-up">
        <h2>What Our Clients Say</h2>
        <div class="test-grid">
            <div class="test-card">
                <div class="stars">★★★★★</div>
                <p>"Absolutely flawless experience. The product quality exceeded my expectations and delivery was incredibly fast."</p>
                <h4>- Rahul S.</h4>
            </div>
            <div class="test-card">
                <div class="stars">★★★★★</div>
                <p>"The UI of the store is amazing, but their customer service is even better. Highly recommend SV Distribution."</p>
                <h4>- Priya M.</h4>
            </div>
            <div class="test-card">
                <div class="stars">★★★★☆</div>
                <p>"Great selection of premium tech products. The packaging was very secure. Will be buying again soon."</p>
                <h4>- Arjun K.</h4>
            </div>
        </div>
    </div>

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
                    <li><a href="{{ route('frontend.news') }}">Latest News</a></li>
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

    <div id="toast">Added to wishlist ❤️</div>

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
                        observer.unobserve(entry.target); // Optional: stops animating once revealed
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