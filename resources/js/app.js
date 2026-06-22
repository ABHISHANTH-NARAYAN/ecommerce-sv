import Alpine from 'alpinejs';
import $ from 'jquery';

window.Alpine = Alpine;
window.$ = window.jQuery = $;

Alpine.start();

/* =========================
   CSRF TOKEN SETUP
========================= */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content')
    }
});

/* =========================
   TOAST NOTIFICATION SYSTEM
========================= */
function showToast(message, type = 'success') {
    const toast = document.createElement('div');

    toast.innerText = message;

    toast.style.position = 'fixed';
    toast.style.bottom = '20px';
    toast.style.right = '20px';
    toast.style.padding = '12px 18px';
    toast.style.borderRadius = '10px';
    toast.style.color = '#fff';
    toast.style.fontSize = '14px';
    toast.style.zIndex = 9999;
    toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.3)';
    toast.style.transition = '0.3s ease';

    if (type === 'success') {
        toast.style.background = '#16a34a';
    } else if (type === 'error') {
        toast.style.background = '#ef4444';
    } else {
        toast.style.background = '#2563eb';
    }

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(20px)';
    }, 2000);

    setTimeout(() => {
        toast.remove();
    }, 2600);
}

window.showToast = showToast;

/* =========================
   ADD TO CART (GLOBAL)
========================= */
$(document).on('click', '.add-to-cart', function () {
    let id = $(this).data('id');

    $.post('/cart/add/' + id, function () {
        showToast('Product added to cart 🛒', 'success');
        updateCartCount();
    }).fail(function () {
        showToast('Failed to add to cart', 'error');
    });
});

/* =========================
   WISHLIST (GLOBAL)
========================= */
$(document).on('click', '.wishlist-btn', function () {
    let id = $(this).data('id');

    $.post('/wishlist/add/' + id, function () {
        showToast('Added to wishlist ❤️', 'success');
    }).fail(function () {
        showToast('Failed to add wishlist', 'error');
    });
});

/* =========================
   CART COUNT UPDATE (OPTIONAL)
========================= */
function updateCartCount() {
    $.get('/cart/count', function (data) {
        $('.cart-badge').text(data.count);
    });
}