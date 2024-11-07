@extends('client.layouts.master')

@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ $product->image }}" alt="Image" class="img-fluid" style="width: 100%; height: auto;">
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p><strong class="text-primary h4">{{ $product->price }}</strong></p>
                    <form action="{{ route('addCart') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="image" value="{{ $product->image }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="description" value="{{ $product->description }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">

                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="number" class="form-control text-center" value="1" min="1"
                                    max="100" name="quantity" placeholder=""
                                    aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                        </div>
                        <div class="mb-1 d-flex">
                            <label for="option-sm" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-sm" name="shop-sizes"></span> <span
                                    class="d-inline-block text-black">Small</span>
                            </label>
                            <label for="option-md" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-md" name="shop-sizes"></span> <span
                                    class="d-inline-block text-black">Medium</span>
                            </label>
                            <label for="option-lg" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-lg" name="shop-sizes"></span> <span
                                    class="d-inline-block text-black">Large</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                        type="radio" id="option-xl" name="shop-sizes"></span> <span
                                    class="d-inline-block text-black"> Extra
                                    Large</span>
                            </label>
                        </div>
                        <input type="submit" class="buy-now btn btn-sm btn-primary" value="Add to cart" name="addcart">



                    </form>



                </div>
            </div>
        </div>
    </div>

    @include('client.components.featured-product', ['count' => 4])
@endsection
