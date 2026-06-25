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