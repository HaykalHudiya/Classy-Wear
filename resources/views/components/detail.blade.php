@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <div class="row justify-content-between">
            {{-- <div class="col-md-2">
                <!-- Thumbnail images -->
                <div class="d-flex flex-column align-items-center">
                    <img src="Assets/newa/Na-1.png" class="img-thumbnail mb-2" alt="Product Image 1">
                    <img src="Assets/newa/Na-1.png" class="img-thumbnail mb-2" alt="Product Image 2">
                    <img src="Assets/newa/Na-1.png" class="img-thumbnail mb-2" alt="Product Image 3">
                </div>
            </div> --}}
            <div class="col-md-5">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <img src="{{ asset('Assets/Shirt/' . $finalProduct['image']) }}" class="d-block w-100"
                            alt="{{ $finalProduct['name'] }}">
                        <div class="carousel-item">
                            <img src="Assets/newa/Na-1.png" class="d-block w-100" alt="Product Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="Assets/newa/Na-1.png" class="d-block w-100" alt="Product Image 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-5" style="background-color: #F3D7CA">
                <h1 class="product-title">{{ $finalProduct['name'] }}</h1>
                <p class="product-price">Rp {{ number_format($finalProduct['price'], 0, ',', '.') }},00</p>
                <div class="mb-3">
                    <label class="form-label fw-bold">Size</label>
                    <div>
                        @foreach ($sizeOrder as $size)
                            @if (in_array($size, $finalProduct['sizes']))
                                <button class="btn btn-outline-secondary btn-sm rounded-circle size-btn"
                                    data-size="{{ $size }}"
                                    data-product-code="{{ $finalProduct['code'] }}">{{ $size }}</button>
                            @else
                                <button
                                    class="btn btn-outline-secondary btn-sm rounded-circle disabled">{{ $size }}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Color</label>
                    <div id="color-buttons-{{ $finalProduct['code'] }}">
                        @foreach ($finalProduct['colors'] as $color)
                            <button class="btn btn-outline-secondary btn-sm rounded-circle color-btn"
                                data-color="{{ $color }}" data-product-code="{{ $finalProduct['code'] }}"
                                style="background-color: {{ $color }}; width: 20px; height: 20px; display: inline-block;"></button>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantity</label>
                    <div class="input-group d-flex justify-content-center">
                        <button class="btn btn-outline-secondary m-0" type="button" id="button-minus">-</button>
                        <input type="number" class="form-control text-center p-0 quantity-input" value="1"
                            min="1" max="{{ $finalProduct['qty'] }}" id="quantity-{{ $finalProduct['code'] }}"
                            readonly>
                        <button class="btn btn-outline-secondary m-0" type="button" id="button-plus">+</button>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button class="btn btn-primary mb-2 me-2 add-to-cart-btn"
                        data-product-code="{{ $finalProduct['code'] }}">Add to Cart</button>
                    <button class="btn btn-dark mb-2 buy-it-now-btn" data-product-code="{{ $finalProduct['code'] }}">Buy
                        now</button>
                </div>
                <label class="form-label mt-1 fw-bold">Description Product</label>
                <p>{{ $finalProduct['desc'] }}</p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('button-minus').addEventListener('click', function() {
            var quantityInput = document.querySelector('input[type="number"]');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        document.getElementById('button-plus').addEventListener('click', function() {
            var quantityInput = document.querySelector('input[type="number"]');
            var currentValue = parseInt(quantityInput.value);
            var maxQty = parseInt("{{ $finalProduct['qty'] }}"); // Ambil nilai maksimum dari Blade

            if (currentValue < maxQty) {
                quantityInput.value = currentValue + 1;
            } else {
                // Optional: Tambahkan logika atau pesan kesalahan jika melebihi maksimum
                console.log('Mencapai batas maksimum jumlah');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ketika tombol ukuran dipilih
            document.querySelectorAll('.size-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var selectedSize = this.getAttribute('data-size');
                    var productCode = this.getAttribute('data-product-code');

                    // Menghapus kelas 'selected' dari semua tombol ukuran
                    document.querySelectorAll('.size-btn[data-product-code="' + productCode + '"]')
                        .forEach(function(btn) {
                            btn.classList.remove('selected');
                        });

                    // Menambahkan kelas 'selected' ke tombol ukuran yang dipilih
                    this.classList.add('selected');

                    // Menyimpan ukuran terpilih di elemen data
                    document.querySelector('#color-buttons-' + productCode).setAttribute(
                        'data-selected-size', selectedSize);

                    // Logika untuk menyesuaikan tombol warna
                    adjustColorButtons(productCode, selectedSize);
                });
            });

            // Ketika tombol warna dipilih
            document.querySelectorAll('.color-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var selectedColor = this.getAttribute('data-color');
                    var productCode = this.getAttribute('data-product-code');

                    // Menghapus kelas 'selected' dari semua tombol warna
                    document.querySelectorAll('.color-btn[data-product-code="' + productCode + '"]')
                        .forEach(function(btn) {
                            btn.classList.remove('selected');
                        });

                    // Menambahkan kelas 'selected' ke tombol warna yang dipilih
                    this.classList.add('selected');

                    // Menyimpan warna terpilih di elemen data
                    document.querySelector('#color-buttons-' + productCode).setAttribute(
                        'data-selected-color', selectedColor);
                });
            });

            // Ketika tombol 'Add to Cart' dipilih
            document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var productCode = this.getAttribute('data-product-code');
                    var selectedSize = document.querySelector('#color-buttons-' + productCode)
                        .getAttribute('data-selected-size');
                    var selectedColor = document.querySelector('#color-buttons-' + productCode)
                        .getAttribute('data-selected-color');
                    var quantity = document.querySelector('#quantity-' + productCode).value;

                    if (selectedSize && selectedColor && quantity) {
                        axios.post('/cart/add', {
                                code: productCode,
                                size: selectedSize,
                                color: selectedColor.replace('#', ''),
                                quantity: quantity
                            })
                            .then(function(response) {
                                if (response.data.success) {
                                    alert("Product added to cart successfully.");
                                    window.location.reload();
                                } else {
                                    alert(response.data.message);
                                }
                            })
                            .catch(function(error) {
                                alert("An error occurred. Please try again.");
                            });
                    } else {
                        alert("Please select size, color, and quantity.");
                    }
                });
            });

            // Ketika tombol 'Buy it Now' dipilih
            document.querySelectorAll('.buy-it-now-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var productCode = this.getAttribute('data-product-code');
                    var selectedSize = document.querySelector('#color-buttons-' + productCode)
                        .getAttribute('data-selected-size');
                    var selectedColor = document.querySelector('#color-buttons-' + productCode)
                        .getAttribute('data-selected-color');
                    var quantity = document.querySelector('#quantity-' + productCode).value;

                    if (selectedSize && selectedColor && quantity) {
                        axios.post('/cart/add', {
                                code: productCode,
                                size: selectedSize,
                                color: selectedColor.replace('#', ''),
                                quantity: quantity
                            })
                            .then(function(response) {
                                if (response.data.success) {
                                    window.location.href =
                                        `/carts?code=${productCode}&size=${selectedSize}&color=${selectedColor.replace('#', '')}&quantity=${quantity}`;
                                } else {
                                    alert(response.data.message);
                                }
                            })
                            .catch(function(error) {
                                alert("An error occurred. Please try again.");
                            });
                    } else {
                        alert("Please select size, color, and quantity.");
                    }
                });
            });
        });

        function adjustColorButtons(productCode, selectedSize) {
            // Logika untuk menyesuaikan tombol warna berdasarkan ukuran terpilih
            var colorButtons = document.querySelectorAll('#color-buttons-' + productCode + ' .color-btn');
            colorButtons.forEach(function(button) {
                var color = button.getAttribute('data-color');
                var available = true; // Misalnya, tentukan apakah ukuran dan warna tertentu tersedia
                if (available) {
                    button.classList.remove('disabled');
                } else {
                    button.classList.add('disabled');
                }
            });
        }
    </script>
@endsection
