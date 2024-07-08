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
                @if ($cart)
                    @foreach ($cart as $index => $item)
                        <tr>
                            <td>{{ $item['product']->name }}</td>
                            <td><img src="{{ asset('Assets/Shirt/' . $item['product']->image) }}"
                                    alt="{{ $item['product']->name }}" width="50"></td>
                            <td id="productPrice-{{ $index }}">Rp
                                {{ number_format($item['product']->price, 0, ',', '.') }},00</td>
                            <td>{{ $item['size'] }}</td>
                            <td>
                                <span
                                    style="background-color: #{{ $item['color'] }}; width: 20px; height: 20px; display: inline-block; border-radius: 50%;"></span>
                            </td>
                            <td id="productQuantity-{{ $index }}">{{ $item['quantity'] }}</td>
                            <td id="totalPrice-{{ $index }}">Rp
                                {{ number_format($item['product']->price * $item['quantity'], 0, ',', '.') }},00</td>
                            <td>
                                <button class="btn btn-danger"
                                    onclick="removeFromCart('{{ $item['product']->code }}', '{{ $item['size'] }}', '{{ $item['color'] }}')">Remove</button>
                            </td>
                        </tr>
                    @endforeach
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal"
                onclick="fillModalForm()">Order</button>
        </form>

        <!-- The Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Detail Orders</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please Check your Orders!!</p>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach ($cart as $index => $item)
                            <div>
                                <p>{{ $item['product']->name }} - {{ $item['quantity'] }} - Rp
                                    {{ number_format($item['product']->price * $item['quantity'], 0, ',', '.') }},00</p>
                            </div>
                            @php
                                $totalPrice += $item['product']->price * $item['quantity'];
                            @endphp
                        @endforeach
                        <p>Total: Rp {{ number_format($totalPrice, 0, ',', '.') }},00</p>
                        <form>
                            <div class="mb-3">
                                <label for="modalName" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="modalName" value="XXXXXXXXXX" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="modalPhone" class="form-label">Phone Number:</label>
                                <input type="text" class="form-control" id="modalPhone" value="XXXXXXXXXX" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="modalAddress" class="form-label">Address:</label>
                                <input type="text" class="form-control" id="modalAddress" value="XXXXXXXXXX" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="modalEmail" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="modalEmail" value="XXXXXXXXXX" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="modalPayment" class="form-label">Payment Method:</label>
                                <input type="text" class="form-control" id="modalPayment" value="XXXXXXXXXX" disabled>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitModalForm()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

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
    </div>

    <script>
        function fillModalForm() {
            // Get values from the main form
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const email = document.getElementById('email').value;
            const payment = document.getElementById('payment').value;

            // Set values to the modal form
            document.getElementById('modalName').value = name;
            document.getElementById('modalPhone').value = phone;
            document.getElementById('modalAddress').value = address;
            document.getElementById('modalEmail').value = email;
            document.getElementById('modalPayment').value = payment;
        }

        function submitModalForm() {
            // Optionally submit the modal form or handle the confirm action
            // Example:
            // document.getElementById('modalForm').submit();
        }

        function calculateTotal(index) {
            const priceElement = document.getElementById(`productPrice-${index}`);
            const quantityElement = document.getElementById(`productQuantity-${index}`);
            const totalPriceElement = document.getElementById(`totalPrice-${index}`);

            const price = parseFloat(priceElement.textContent.replace('Rp ', '').replace(/\./g, '').replace(',', '.'));
            const quantity = parseInt(quantityElement.textContent);

            const totalPrice = price * quantity;
            totalPriceElement.textContent =
                `Rp ${totalPrice.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })},00`;
        }

        function removeFromCart(code, size, color) {
            axios.post('/carts/remove', {
                    code: code,
                    size: size,
                    color: color
                })
                .then(function(response) {
                    if (response.data.success) {
                        window.location.reload();
                    } else {
                        alert("Failed to remove item from cart: " + response.data.message);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                    alert("An error occurred. Please try again.");
                });
        }
    </script>
@endsection
