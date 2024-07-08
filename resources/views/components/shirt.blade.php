@extends('layouts.app')
@section('search')
    <div class="search-container d-flex flex-row-reverse mt-3">
        <input class="form-control" type="search" placeholder="What can i help you to find ?" aria-label="Search">
        <i class="bi bi-search search-icon"></i>
    </div>
@endsection
@section('content')
    <div class="container my-4">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <a href="{{ route('frame.detail', ['code' => $product['code']]) }}">
                        <div class="card product-card">
                            <img src="{{ asset('Assets/Shirt/' . $product['image']) }}" class="card-img-top product-img"
                                alt="{{ $product['name'] }}">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#productModal{{ $product['code'] }}">
                                <i class="bi bi-cart-check search-icons"></i>
                            </a>
                        </div>
                    </a>
                    <h1> {{ $product['name'] }} </h1>
                    <h4>Rp {{ number_format($product['price'], 0, ',', '.') }},00</h4>
                </div>
                <div class="modal fade" id="productModal{{ $product['code'] }}" tabindex="-1"
                    aria-labelledby="productModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #B67685">
                                <h5 class="modal-title text-white" id="productModalLabel">{{ $product['name'] }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #F5EEE6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('Assets/Shirt/' . $product['image']) }}"
                                            class="card-img-top product-img" alt="{{ $product['name'] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <h3>{{ $product['name'] }}</h3>
                                        <p>Rp {{ number_format($product['price'], 0, ',', '.') }},00</p>
                                        <div class="mb-3">
                                            <label class="form-label">Size</label>
                                            <div>
                                                @foreach ($sizeOrder as $size)
                                                    @if (in_array($size, $product['sizes']))
                                                        <button
                                                            class="btn btn-outline-secondary btn-sm rounded-circle size-btn"
                                                            data-size="{{ $size }}"
                                                            data-product-code="{{ $product['code'] }}">{{ $size }}</button>
                                                    @else
                                                        <button
                                                            class="btn btn-outline-secondary btn-sm rounded-circle disabled">{{ $size }}</button>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label class="form-label">Color</label>
                                            <div id="color-buttons-{{ $product['code'] }}">
                                                @foreach ($product['colors'] as $color)
                                                    <button
                                                        class="btn btn-outline-secondary btn-sm rounded-circle color-btn"
                                                        style="background-color: {{ $color }}"
                                                        data-color="{{ $color }}"
                                                        data-product-code="{{ $product['code'] }}"></button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('frame.detail', ['code' => $product['code']]) }}">View
                                                details</a>
                                            <button class="btn btn-dark buy-it-now-btn"
                                                data-product-code="{{ $product['code'] }}">Buy now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
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

                    // Menyimpan ukuran terpilih di element data
                    document.querySelector('#productModal' + productCode).setAttribute(
                        'data-selected-size', selectedSize);

                    // Logika untuk menyesuaikan tombol warna
                    adjustColorButtons(productCode, selectedSize);
                });
            });

            // Ketika tombol warna dipilih
            document.querySelectorAll('.color-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var selectedColor = this.getAttribute('data-color');
                    var productCode = this.closest('.modal').id.replace('productModal', '');

                    // Menghapus kelas 'selected' dari semua tombol warna
                    document.querySelectorAll('.color-btn[data-product-code="' + productCode + '"]')
                        .forEach(function(btn) {
                            btn.classList.remove('selected');
                        });

                    // Menambahkan kelas 'selected' ke tombol warna yang dipilih
                    this.classList.add('selected');

                    // Menyimpan warna terpilih di element data
                    document.querySelector('#productModal' + productCode).setAttribute(
                        'data-selected-color', selectedColor);
                });
            });

            // Ketika tombol 'Buy it Now' dipilih
            document.querySelectorAll('.buy-it-now-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var productCode = this.getAttribute('data-product-code');
                    var selectedSize = document.querySelector('#productModal' + productCode)
                        .getAttribute('data-selected-size');
                    var selectedColor = document.querySelector('#productModal' + productCode)
                        .getAttribute('data-selected-color');

                    if (selectedSize && selectedColor) {
                        axios.get('/shirt/shirt', {
                                params: {
                                    code: productCode,
                                    size: selectedSize,
                                    color: selectedColor.replace('#', '')
                                }
                            })
                            .then(function(response) {
                                window.location.href =
                                    `/carts?code=${productCode}&size=${selectedSize}&color=${selectedColor.replace('#', '')}`;
                            })
                            .catch(function(error) {
                                alert("Terjadi kesalahan. Silakan coba lagi.");
                            });
                    } else {
                        alert("Silakan pilih ukuran dan warna.");
                    }
                });
            });

            // document.querySelectorAll('.buy-it-now-btn').forEach(function(button) {
            //     button.addEventListener('click', function() {
            //         var productCode = this.getAttribute('data-product-code');
            //         var selectedSize = document.querySelector('#productModal' + productCode)
            //             .getAttribute('data-selected-size');
            //         var selectedColor = document.querySelector('#productModal' + productCode)
            //             .getAttribute('data-selected-color');

            //         // Redirect ke halaman cart dengan parameter query
            //         if (selectedSize && selectedColor) {
            //             let color = selectedColor;
            //             let cleanedColor = color.replace('#', ''); // Menghilangkan karakter '#'
            //             window.location.href =
            //                 `/cart?code=${productCode}&size=${selectedSize}&color=${cleanedColor}`;
            //         } if (condition) {
            //             alert("Stok sedang tidak ada.");
            //         } else {
            //             alert("Please select both size and color.");
            //         }
            //     });
            // });

            // Ketika modal ditutup
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    var productCode = this.id.replace('productModal', '');

                    // Menghapus kelas 'selected' dari semua tombol ukuran dan warna
                    document.querySelectorAll('.size-btn[data-product-code="' + productCode + '"]')
                        .forEach(function(btn) {
                            btn.classList.remove('selected');
                        });
                    document.querySelectorAll('.color-btn[data-product-code="' + productCode + '"]')
                        .forEach(function(btn) {
                            btn.classList.remove('selected');
                        });

                    // Menghapus ukuran dan warna terpilih dari element data
                    this.removeAttribute('data-selected-size');
                    this.removeAttribute('data-selected-color');
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
