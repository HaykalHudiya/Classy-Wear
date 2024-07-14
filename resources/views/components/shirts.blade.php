@php
    $productCount = count($products);
    $productClass = $productCount == 1 ? 'single-product' : ($productCount == 2 ? 'double-product' : '');
@endphp

@foreach ($products as $product)
    <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="product-wrapper {{ $productClass }}">
            <a href="{{ route('frame.detail', ['code' => $product['code']]) }}" class="text-decoration-none text-dark">
                <div class="card product-card">
                    <img src="{{ asset('Assets/' . $product['type'] . '/' . $product['image']) }}"
                        class="card-img-top product-img" alt="{{ $product['name'] }}">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#productModal{{ $product['code'] }}">
                        <i class="bi bi-cart-check search-icons"></i>
                    </a>
                </div>
            </a>
            <h1 class="product-title h5 text-center mt-2">{{ $product['name'] }}</h1>
            <h4 class="product-price h6 text-center">Rp {{ number_format($product['price'], 0, ',', '.') }},00</h4>
        </div>
    </div>

    <div class="modal fade" id="productModal{{ $product['code'] }}" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #B67685">
                    <h5 class="modal-title text-white" id="productModalLabel">{{ $product['name'] }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #F5EEE6">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <img src="{{ asset('Assets/' . $product['type'] . '/' . $product['image']) }}"
                                class="img-fluid" alt="{{ $product['name'] }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <h3 class="h5">{{ $product['name'] }}</h3>
                            <p class="h6">Rp {{ number_format($product['price'], 0, ',', '.') }},00</p>
                            <div class="mb-3">
                                <label class="form-label">Size</label>
                                <div class="d-flex flex-wrap">
                                    @foreach ($sizeOrder as $size)
                                        @if (in_array($size, $product['sizes']))
                                            <button class="btn btn-outline-secondary btn-sm rounded-circle size-btn m-1"
                                                data-size="{{ $size }}"
                                                data-product-code="{{ $product['code'] }}">{{ $size }}</button>
                                        @else
                                            <button
                                                class="btn btn-outline-secondary btn-sm rounded-circle disabled m-1">{{ $size }}</button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="form-label">Color</label>
                                <div id="color-buttons-{{ $product['code'] }}" class="d-flex flex-wrap">
                                    @foreach ($product['colors'] as $color)
                                        <button class="btn btn-outline-secondary btn-sm rounded-circle color-btn m-1"
                                            style="background-color: {{ $color }}"
                                            data-color="{{ $color }}"
                                            data-product-code="{{ $product['code'] }}"></button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{ route('frame.detail', ['code' => $product['code']]) }}"
                                    class="btn btn-link">View details</a>
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
