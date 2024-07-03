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
                        <div class="carousel-item active">
                            <img src="Assets/newa/Na-1.png" class="d-block w-100" alt="Product Image 1">
                        </div>
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
                <h1 class="product-title">Product Name</h1>
                <p class="product-price">Rp 379.000,00</p>
                <div class="mb-3">
                    <label class="form-label">Size</label>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle">S</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle">M</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle">L</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle">XL</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle disabled">XXL</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle"
                            style="background-color: red"></button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle"
                            style="background-color: red"></button>
                        <button class="btn btn-outline-secondary btn-sm rounded-circle"
                            style="background-color: red"></button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" id="button-minus">-</button>
                        <input type="number" class="form-control text-center" value="1" min="1" max="10">
                        <button class="btn btn-outline-secondary" type="button" id="button-plus">+</button>
                    </div>
                </div>
                <button class="btn btn-primary mb-2">Add to Cart</button>
                <button class="btn btn-dark mb-2">Buy it Now</button>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                    essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                    Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                    PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </div>
    </div>
@endsection
