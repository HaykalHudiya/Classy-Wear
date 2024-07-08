@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <h1>Cart Summary</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset('Assets/Shirt/' . $product->image) }}" alt="{{ $product->name }}"
                                width="50"></td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }},00</td>
                        <td>{{ request()->query('size') }}</td>
                        <td>
                            <span
                                style="background-color: {{ request()->query('color') }}; width: 20px; height: 20px; display: inline-block;"></span>
                        </td>
                        <td>1</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }},00</td>
                        <td><button class="btn btn-danger">Remove</button></td>
                    </tr>
                @else
                    <tr>
                        <td colspan="8" class="text-center">No products in the cart.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <h2>Checkout</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter your address">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="payment" class="form-label">Payment Method</label>
                <input type="text" class="form-control" id="payment" placeholder="Enter payment method">
            </div>
            <button type="submit" class="btn btn-primary">Order</button>
        </form>

        <h2 class="mt-5">Recommended Products</h2>
        <div class="recommended-products row">
            <div class="col-md-2">
                <div class="card">
                    <img src="path_to_image_3.jpg" class="card-img-top" alt="Stripe Cardigan">
                    <div class="card-body text-center">
                        <p class="card-text">Rp. 99.000<br>Stripe Cardigan</p>
                        <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="path_to_image_4.jpg" class="card-img-top" alt="Knitted Sweater">
                    <div class="card-body text-center">
                        <p class="card-text">Rp. 99.000<br>Knitted Sweater</p>
                        <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="path_to_image_5.jpg" class="card-img-top" alt="Knitted Sweater">
                    <div class="card-body text-center">
                        <p class="card-text">Rp. 199.000<br>Knitted Sweater</p>
                        <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="path_to_image_6.jpg" class="card-img-top" alt="Knitted Sweater">
                    <div class="card-body text-center">
                        <p class="card-text">Rp. 189.000<br>Knitted Sweater</p>
                        <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="path_to_image_7.jpg" class="card-img-top" alt="Shirt">
                    <div class="card-body text-center">
                        <p class="card-text">Rp. 499.000<br>Shirt</p>
                        <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function calculateTotal() {
                const priceElement = document.getElementById('productPrice');
                const quantityElement = document.getElementById('productQuantity');
                const totalPriceElement = document.getElementById('totalPrice');

                const price = parseFloat(priceElement.textContent.replace('Rp ', '').replace('.', '').replace(',', '.'));
                const quantity = parseInt(quantityElement.textContent);

                const totalPrice = price * quantity;
                totalPriceElement.textContent =
                    `Rp ${totalPrice.toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            }
        </script>
    </div>
@endsection
