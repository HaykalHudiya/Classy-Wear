<header>
    <div class="d-flex flex-column text-center" style="background-color: #F3D7CA">
        <div class="d-flex flex-row flex-wrap p-2 justify-content-between align-items-center">
            <a href="/">
                <img class="d-block mx-auto" src="{{ asset('Assets/Icon/logo-CW.png') }}" alt="" width="100"
                    height="100">
            </a>
            <div class="p-2">
                <h2 class="h4 fw-bold">Wear Confidence <br> Wear Us</h2>
            </div>
            <div class="p-2 cart-icon">
                <a href="/carts">
                    <img src="{{ asset('Assets/Icon/cart.png') }}" alt="" width="50" height="50">
                    @if (session('cart') && count(session('cart')) > 0)
                        <span class="badge">{{ count(session('cart')) }}</span>
                    @endif
                </a>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function updateCartCount() {
                    $.ajax({
                        url: '/cart/count',
                        method: 'GET',
                        success: function(data) {
                            $('.cart-icon .badge').text(data.count);
                        }
                    });
                }

                // Call this function when you update the cart
                updateCartCount();
            </script>
        </div>
        <nav class="navbar navbar-expand-lg custom-navbar" style="background-color: #FFF8E3">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav flex-fill justify-content-center">
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/newarrival">New Arrival</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/best-seller">Best Seller</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/shirt">Shirt</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/outerwear">Outerwear</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/tshirt">T-Shirt</a>
                        </li>
                        <li class="nav-item flex-fill text-center">
                            <a class="nav-link p-4" href="/pants">Pants</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
