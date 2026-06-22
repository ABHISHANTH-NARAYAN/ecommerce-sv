<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | SV Distribution</title>
    <style>
        /* =========================================
           RESET & TYPOGRAPHY
           ========================================= */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #05050a;
            color: #f8fafc;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* =========================================
           AMBIENT BACKGROUND
           ========================================= */
        .ambient-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1; overflow: hidden; background: #05050a;
        }
        .ambient-glow {
            position: absolute; border-radius: 50%; filter: blur(140px); opacity: 0.3;
            animation: pulseGlow 10s infinite alternate ease-in-out;
        }
        .glow-1 { top: -10%; left: -10%; width: 50vw; height: 50vw; background: #4f46e5; }
        .glow-2 { bottom: -20%; right: -10%; width: 60vw; height: 60vw; background: #0ea5e9; }

        @keyframes pulseGlow {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.1) translate(30px, -30px); }
        }

        /* =========================================
           NAVIGATION
           ========================================= */
        .nav-wrapper {
            position: fixed; top: 20px; left: 0; width: 100%; z-index: 100;
            display: flex; justify-content: center; padding: 0 20px;
        }
        .nav {
            display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 1200px;
            background: rgba(15, 15, 20, 0.6); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08); padding: 12px 24px; border-radius: 20px;
        }
        .nav-brand { font-size: 22px; font-weight: 800; color: #fff; text-decoration: none; }
        .nav-links { display: flex; gap: 8px; }
        .nav a { color: #cbd5e1; text-decoration: none; font-size: 14px; font-weight: 500; padding: 8px 16px; border-radius: 12px; transition: 0.3s; }
        .nav a:hover { color: #fff; background: rgba(255, 255, 255, 0.1); }

        /* =========================================
           PRODUCT SHOWCASE & ZOOM GALLERY
           ========================================= */
        .product-showcase {
            max-width: 1200px;
            margin: 120px auto 80px;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        /* Top Actions */
        .top-actions {
            grid-column: 1 / -1;
            margin-bottom: -20px;
        }
        .back-btn {
            display: inline-flex; align-items: center; gap: 8px;
            color: #94a3b8; text-decoration: none; font-weight: 600; font-size: 15px;
            padding: 8px 16px; border-radius: 12px; background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;
        }
        .back-btn:hover { color: #fff; background: rgba(255,255,255,0.1); transform: translateX(-4px); }

        /* Gallery Layout */
        .product-gallery { position: sticky; top: 120px; height: fit-content; }
        
        /* The Zoom Container */
        .main-image-container {
            width: 100%;
            height: 500px;
            border-radius: 24px;
            background: rgba(15, 15, 20, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            overflow: hidden; /* Crucial for zoom */
            position: relative;
            cursor: crosshair; /* Shows user they can interact */
            margin-bottom: 20px;
        }

        .main-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Smooth transition when zooming in and out */
            transition: transform 0.2s ease-out; 
            pointer-events: none; /* Let the container handle mouse events */
        }

        /* Thumbnails */
        .thumbnail-row {
            display: flex; gap: 15px; overflow-x: auto; padding-bottom: 10px;
        }
        .thumbnail {
            width: 80px; height: 80px; border-radius: 12px; cursor: pointer;
            border: 2px solid transparent; opacity: 0.6; transition: 0.3s;
            object-fit: cover; background: rgba(255,255,255,0.05);
        }
        .thumbnail:hover, .thumbnail.active { opacity: 1; border-color: #3b82f6; }

        /* Right Column Details */
        .product-title { font-size: 42px; font-weight: 800; line-height: 1.1; margin-bottom: 15px; color: #ffffff; }
        .product-meta { display: flex; align-items: center; gap: 20px; margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); }
        .stars { color: #f59e0b; font-weight: 600; font-size: 15px; }
        .product-price { font-size: 36px; font-weight: 700; color: #34d399; margin-bottom: 30px; }

        .description-box {
            background: rgba(15, 15, 20, 0.4); border: 1px solid rgba(255, 255, 255, 0.08);
            border-left: 3px solid #3b82f6; border-radius: 16px; padding: 24px;
            margin-bottom: 40px; backdrop-filter: blur(20px);
        }
        .description-box h3 { font-size: 14px; color: #94a3b8; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .description-box p { color: #cbd5e1; line-height: 1.7; font-size: 15px; }

        /* =========================================
           ACTION BUTTONS (Matching Home Page)
           ========================================= */
        .action-group { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;}
        
        .btn-cart {
            grid-column: 1 / -1; background: #fff; color: #000; padding: 16px;
            border-radius: 14px; font-weight: 700; font-size: 16px; border: none; cursor: pointer; transition: 0.3s;
        }
        .btn-cart:hover { background: #e2e8f0; transform: translateY(-2px); }

        .btn-icon {
            background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff; padding: 14px; border-radius: 14px; font-size: 15px; font-weight: 600;
            text-align: center; text-decoration: none; transition: 0.3s; display: block;
        }
        .btn-icon:hover { background: rgba(255, 255, 255, 0.1); transform: translateY(-2px); }
        .btn-icon.green:hover { border-color: #22c55e; color: #22c55e; }

        .btn-wishlist {
            grid-column: 1 / -1; background: transparent; border: 1px dashed rgba(239, 68, 68, 0.4);
            color: #fca5a5; padding: 14px; border-radius: 14px; font-weight: 600; font-size: 15px;
            cursor: pointer; transition: 0.3s;
        }
        .btn-wishlist:hover { border-style: solid; background: rgba(239, 68, 68, 0.1); color: #ffffff; }

        /* Quantity Form Row */
        .qty-row { display: flex; gap: 15px; margin-bottom: 20px; }
        .qty-wrapper {
            display: flex; align-items: center; background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 14px; overflow: hidden;
        }
        .qty-btn {
            background: transparent; border: none; color: #94a3b8; width: 45px; height: 100%;
            font-size: 20px; cursor: pointer; transition: 0.3s;
        }
        .qty-btn:hover { background: rgba(255, 255, 255, 0.1); color: #fff; }
        .qty-input {
            width: 50px; background: transparent; border: none; color: white; text-align: center;
            font-size: 16px; font-weight: 700; outline: none; -moz-appearance: textfield; 
        }
        .qty-input::-webkit-outer-spin-button, .qty-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

        @media(max-width: 900px) {
            .product-showcase { grid-template-columns: 1fr; gap: 40px; }
            .product-gallery { position: relative; top: 0; }
        }
    </style>
</head>
<body>

    <div class="ambient-bg">
        <div class="ambient-glow glow-1"></div>
        <div class="ambient-glow glow-2"></div>
    </div>

    <!-- Navigation -->
    <div class="nav-wrapper">
        <nav class="nav">
            <a href="{{ route('home') }}" class="nav-brand">SV Distribution.</a>
            <div class="nav-links">
                <a href="{{ route('cart.index') }}">Cart</a>
            </div>
        </nav>
    </div>

    <!-- Product Details -->
    <div class="product-showcase">
        
        <!-- Back Button -->
        <div class="top-actions">
            <a href="{{ route('home') }}" class="back-btn">
                ← Back to Store
            </a>
        </div>
        
        <!-- Left: Zoom Gallery -->
        <div class="product-gallery">
            <!-- Main Image (Hover to Zoom) -->
            <div class="main-image-container" id="zoom-container">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" id="main-image" alt="{{ $product->name }}">
                @else
                    <div style="height:100%; display:flex; align-items:center; justify-content:center;">No Image</div>
                @endif
            </div>

            <!-- Thumbnail Row (Click to change main image) -->
            <div class="thumbnail-row">
                <!-- If you have multiple images in your DB, you would loop them here. 
                     For now, we put the main image as the first thumbnail -->
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="thumbnail active" data-src="{{ asset('storage/' . $product->image) }}">
                @endif
                
                <!-- Mockup extra thumbnails to show how it works (You can remove these if you don't have secondary images) -->
                <!-- 
                <img src="path_to_image_2.jpg" class="thumbnail" data-src="path_to_image_2.jpg">
                <img src="path_to_image_3.jpg" class="thumbnail" data-src="path_to_image_3.jpg">
                -->
            </div>
        </div>

        <!-- Right: Details & Actions -->
        <div class="product-details">
            <h1 class="product-title">{{ $product->name }}</h1>

            <div class="product-meta">
                <span class="stars">★ {{ number_format($product->reviews->avg('rating') ?? 5, 1) }}</span>
                <span style="color: #94a3b8;">Stock: {{ $product->stock }}</span>
            </div>

            <div class="product-price">₹{{ number_format($product->price, 2) }}</div>

            <!-- Description Box -->
            <div class="description-box">
                <h3>Product Overview</h3>
                <p>{!! nl2br(e($product->description)) !!}</p>
            </div>

            <!-- Add to Cart Form -->
            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <div class="qty-row">
                    <div class="qty-wrapper">
                        <button type="button" class="qty-btn minus-btn">−</button>
                        <input type="number" name="quantity" class="qty-input" value="1" min="1" max="{{ $product->stock }}">
                        <button type="button" class="qty-btn plus-btn">+</button>
                    </div>
                    <button type="submit" class="btn-cart" {{ $product->stock < 1 ? 'disabled' : '' }} style="flex:1;">
                        {{ $product->stock < 1 ? 'Sold Out' : 'Add to Cart' }}
                    </button>
                </div>
            </form>

            <!-- Secondary Actions -->
            <div class="action-group">
                <a href="{{ route('enquiries.create', $product->id) }}" class="btn-icon">Enquire</a>
                <a href="https://wa.me/918075929967?text=Hi%20I%20am%20interested%20in%20{{ urlencode($product->name) }}" class="btn-icon green">WhatsApp</a>
                <button class="btn-wishlist wishlist-btn" data-id="{{ $product->id }}">❤️ Add to Wishlist</button>
            </div>

        </div>
    </div>

    <!-- Scripts for Zoom & Gallery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            
            /* =========================================
               1. IMAGE ZOOM SCRIPT
               ========================================= */
            const $container = $('#zoom-container');
            const $image = $('#main-image');

            $container.on('mousemove', function(e) {
                // Get container dimensions and offset
                const rect = this.getBoundingClientRect();
                
                // Calculate mouse position percentage
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;

                // Move the transform origin to the mouse location and scale up
                $image.css({
                    'transform-origin': `${x}% ${y}%`,
                    'transform': 'scale(2.5)' // Adjust this value to increase/decrease zoom level
                });
            });

            $container.on('mouseleave', function() {
                // Reset image on mouse leave
                $image.css({
                    'transform-origin': 'center center',
                    'transform': 'scale(1)'
                });
            });

            /* =========================================
               2. GALLERY THUMBNAIL CLICK
               ========================================= */
            $('.thumbnail').on('click', function() {
                // Remove active class from all, add to clicked
                $('.thumbnail').removeClass('active');
                $(this).addClass('active');

                // Get new image source and swap it
                const newSrc = $(this).data('src');
                $('#main-image').attr('src', newSrc);
            });

            /* =========================================
               3. QUANTITY CONTROLS
               ========================================= */
            $('.plus-btn').on('click', function() {
                let $input = $(this).siblings('.qty-input');
                let max = parseInt($input.attr('max'));
                let currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal < max) {
                    $input.val(currentVal + 1);
                }
            });

            $('.minus-btn').on('click', function() {
                let $input = $(this).siblings('.qty-input');
                let currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    $input.val(currentVal - 1);
                }
            });

            /* =========================================
               4. WISHLIST AJAX
               ========================================= */
            $('.wishlist-btn').on('click', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let btn = $(this);

                $.post("/wishlist/add/" + id, {
                    _token: "{{ csrf_token() }}"
                }, function () {
                    let originalText = btn.text();
                    btn.text('✓ Added to Wishlist').css({'color': '#10b981', 'border-color': '#10b981'});
                    setTimeout(function(){
                        btn.text(originalText).css({'color': '#fca5a5', 'border-color': 'rgba(239, 68, 68, 0.4)'});
                    }, 2000);
                });
            });
        });
    </script>
</body>
</html>