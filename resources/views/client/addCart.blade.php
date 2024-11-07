@extends('client.layouts.master')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ url('/') }}">Home</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp

                                @foreach (session('cart', []) as $product)
                                    @php
                                        $productTotal = $product['quantity'] * $product['price'];
                                        $total += $productTotal;
                                    @endphp

                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ $product['image'] }}" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $product['name'] }}</h2>
                                        </td>
                                        <td class="product-price" data-price="{{ $product['price'] }}">
                                            ${{ $product['price'] }}
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-center quantity-input"
                                                value="{{ $product['quantity'] }}" min="1"
                                                data-product-id="{{ $product['id'] }}">
                                        </td>
                                        <td class="product-total" id="product-total-{{ $product['id'] }}">
                                            ${{ $productTotal }}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm remove-item"
                                                data-product-id="{{ $product['id'] }}">X</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <a href="/clientProducts">
                                <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="cart-total">${{ $total }}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block"
                                        onclick="window.location='{{ route('checkout') }}'">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');

            quantityInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const productId = this.dataset.productId;
                    const quantity = this.value;

                    // Gửi yêu cầu AJAX để cập nhật giỏ hàng
                    fetch("{{ route('cart.update') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Cập nhật tổng giá trị giỏ hàng
                            document.getElementById('cart-total').textContent =
                                `$${data.total.toFixed(2)}`;
                        });
                });
            });
        });
    </script>
@endsection
