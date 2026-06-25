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