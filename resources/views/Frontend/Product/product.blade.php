@extends('Frontend.layouts.app1')

@section('noidung')
<div class="col-sm-20 padding-right">
    <div class="features_items">
        <h2 class="title text-center">Features Items</h2>
        <!-- Form tìm kiếm -->
        <div class="search-form">
            <form action="{{ route('product.search') }}" method="POST" class="form-inline w-100">
                @csrf
                <div class="row w-100 align-items-center">
                    <div class="form-group col-md-2">
                        <label for="name" class="sr-only">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Product name">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="price_max" class="sr-only">Choose Price:</label>
                        <select id="price_max" name="price_max" class="form-control">
                            <option value="">Choose Price</option>
                            <option value="0-1000">Up to 1000</option>
                            <option value="1000-2000">1000 to 2000</option>
                            <option value="2000-3000">2000 to 3000</option>
                            <option value="3000-4000">3000 to 4000</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="category" class="sr-only">Category:</label>
                        <select id="category" name="category" class="form-control">
                            <option value="">Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="brand" class="sr-only">Brand:</label>
                        <select id="brand" name="brand" class="form-control">
                            <option value="">Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="status" class="sr-only">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Status</option>
                            <option value="1">In Stock</option>
                            <option value="0">Out of Stock</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
        
        
        <!-- End form tìm kiếm -->

        <div id="product-list" class="row">
            @foreach($products as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            @php
                                $images = json_decode($product->hinhanh, true);
                            @endphp
                            @if(!empty($images))
                                <img src="{{ asset('upload/product/' . $images[0]) }}" alt="" />
                            @endif
                            <h2>{{ $product->price }}</h2>
                            <p>{{ $product->name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{ $product->price }}</h2>
                                <p>{{ $product->name }}</p>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="{{ route('product.show', $product->id) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="{{ route('product.show', $product->id) }}"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            {{-- {{ $products->links() }} --}}
        </div>
    </div>
</div>
@endsection
