@extends('layouts.frontend')

@section('title', 'SV Distribution | Premium Products')

@section('content')
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
@endsection