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
                    <label class="form-label">Size</label>
                    <div>
                        @foreach ($sizeOrder as $size)
                            @if (in_array($size, $finalProduct['sizes']))
                                <button class="btn btn-outline-secondary btn-sm rounded-circle">{{ $size }}</button>
                            @else
                                <button
                                    class="btn btn-outline-secondary btn-sm rounded-circle disabled">{{ $size }}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <div>
                        @foreach ($finalProduct['colors'] as $color)
                            <button class="btn btn-outline-secondary btn-sm rounded-circle"
                                style="background-color: #{{ $color }}; width: 20px; height: 20px; display: inline-block;"></button>
                        @endforeach

                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <div class="input-group d-flex justify-content-center">
                        <button class="btn btn-outline-secondary m-0" type="button" id="button-minus">-</button>
                        <input type="number" class="form-control text-center p-0" value="1" min="1"
                            max="{{ $finalProduct['qty'] }}" readonly id="quantity">

                        <button class="btn btn-outline-secondary m-0" type="button" id="button-plus">+</button>
                    </div>
                </div>
                <button class="btn btn-primary mb-2">Add to Cart</button>
                <button class="btn btn-dark mb-2">Buy it Now</button>
                <label class="form-label mt-1">Description Product</label>
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
@endsection
