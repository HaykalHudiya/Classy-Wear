{{-- <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #B67685">
                <h5 class="modal-title text-white" id="productModalLabel">Product Name</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #F5EEE6">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('Assets/Shirt/' . $product->image) }}" class="card-img-top product-img"
                            alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-6">
                        <h3>{{ $product->name }}</h3>
                        <p>Rp {{ number_format($product->price, 0, ',', '.') }},00</p>
                        <div class="mb-3">
                            <label class="form-label">Size</label>
                            <div>
                                @foreach ($product->size as $size)
                                    <button
                                        class="btn btn-outline-secondary btn-sm rounded-circle">{{ $size->name }}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <div>
                                @foreach ($product->color as $color)
                                    <button class="btn btn-outline-secondary btn-sm rounded-circle"
                                        style="background-color: {{ $color->code }}"></button>
                                @endforeach
                            </div>
                        </div>
                        <button class="btn btn-primary">Add to Cart</button>
                        <button class="btn btn-dark">Buy it Now</button>
                        <div class="mt-3">
                            <a href="#">View details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
