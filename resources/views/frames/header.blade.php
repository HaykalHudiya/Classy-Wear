<header>
    <div class="d-flex flex-column text-center" style="background-color: #F3D7CA">
        <div class="d-flex flex-row p-2 justify-content-between">
            <a href="/">
                <img class="d-block mx-auto" src="{{ asset('Assets\Icon\logo-CW.png') }}" alt="" width="200"
                    height="200">
            </a>
            <div class="p-2">
                <h2>Wear Confidence <br> Wear Us</h2>
            </div>
            <div class="p-2 cart-icon">
                <a href="/carts">
                    <img src="{{ asset('Assets\Icon\cart.png') }}" alt="">
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
        <nav class="navbar custom-navbar" style="background-color: #FFF8E3">
            <div class="container-fluid d-flex justify-content-center">
                <ul class="nav flex-fill justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link p-4" href="http://127.0.0.1:8000/new-arrival">New
                            Arrival</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link p-4" href="http://127.0.0.1:8000/best-seller">Best
                            Seller</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link p-4" href="http://127.0.0.1:8000/shirt">Shirt</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link p-4" href="http://127.0.0.1:8000/outwear">Outerwear</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link p-4" href="http://127.0.0.1:8000/t-shirt">T-Shirt</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link p-4" href="http://127.0.0.1:8000/pants">Pants</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
