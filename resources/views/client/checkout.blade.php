@extends('client.layouts.master')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a
                        href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Người nhận</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Tên người nhận <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_companyname" name="c_companyname"
                                    placeholder="Nhập tên người nhận">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Địa chỉ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" name="c_address"
                                    placeholder="Nhập địa chỉ">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_email_address" name="c_email_address"
                                    placeholder="Nhập Email">
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" name="c_phone"
                                    placeholder="Nhập SĐT">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Ghi chú</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="Viết ghi chú"></textarea>
                        </div>

                    </div>
                </div>
                <div class="col-md-7">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Đơn hàng của bạn</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Sản phẩm</th>
                                        <th>Name</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>



                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach (session('cart', []) as $product)
                                            @php
                                                $productTotal = $product['quantity'] * $product['price'];
                                                $total += $productTotal;
                                            @endphp
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <img src="{{ $product['image'] }}" alt="Image" class="img-fluid">
                                                </td>
                                                <td>
                                                    <h2 class="h5 text-black">{{ $product['name'] }}</h2>
                                                </td>
                                                <td>
                                                    ${{ $product['price'] }}
                                                </td>
                                                <td>
                                                    {{ $product['quantity'] }}
                                                </td>
                                                <td>
                                                    ${{ $productTotal }}
                                                </td>

                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>${{ $total }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg py-3 btn-block"
                                        onclick="window.location='thankyou.html'">Đặt hàng</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
@endsection
