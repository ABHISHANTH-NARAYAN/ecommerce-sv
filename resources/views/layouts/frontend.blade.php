<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SV Distribution | Premium Products')</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
</head>

<body>
    <div class="aurora"></div>
    <div class="floating-orb orb1"></div>
    <div class="floating-orb orb2"></div>
    <div class="floating-orb orb3"></div>

    @include('partials.headder')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <div id="toast">Added to wishlist ❤️</div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Wishlist AJAX
            $(document).on('click', '.wishlist-btn', function (e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.post("/wishlist/add/" + id, {
                    _token: "{{ csrf_token() }}" // Ensure you have <meta name="csrf-token" content="{{ csrf_token() }}"> in your head if this fails
                }, function () {
                    $('#toast').fadeIn();
                    setTimeout(function(){
                        $('#toast').fadeOut();
                    }, 3000);
                });
            });

            // Scroll Reveal Animation Observer
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