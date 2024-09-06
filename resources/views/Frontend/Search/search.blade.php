@extends('Frontend.layouts.app1')

@section('noidung')
<div class="container">
    <div class="row">
        @if(isset($message))
            <div class="alert alert-warning">{{ $message }}</div>
        @endif
        @isset($products)
            @foreach ($products as $product)
                <div class="col-sm-12">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                @php
                                    $images = json_decode($product->hinhanh, true);
                                    $imageSrc = !empty($images) ? asset('upload/product/' . $images[0]) : asset('upload/product/default.jpg');
                                @endphp
                                <a href="{{ $imageSrc }}" rel="prettyPhoto">
                                    <img src="{{ $imageSrc }}" alt="{{ $product->name }}" width="300px">
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h2>{{ $product->name }}</h2>
                                <p>Web ID: {{ $product->id }}</p>
                                <img src="{{ asset('Frontend/images/product-details/rating.png') }}" alt="" /> <br> 
                                
                                <span>
                                    <span>{{ $product->price }}</span>
                                    <input type="text" value="1" id="quantity" />
                                    <input type="hidden" name="product_id[]" value="{{ $product->id }}"><br>
                                    <button type="button" class="btn btn-fefault cart" id="add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </span>
                                <p><b>Price:</b> {{ $product->price }}</p>
                                <p><b>Detail:</b> {{ $product->detail }}</p>
                                <p><b>Status:</b> {{ $product->status ? 'In Stock' : 'Out of Stock' }}</p>
                                <a href=""><img src="{{ asset('Frontend/images/product-details/share.png') }}" class="share img-responsive" alt="" /></a>

                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->
                </div>
            @endforeach
        @endisset
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.cart').click(function() {
        var productId = $(this).data('product-id');
        var quantity = $(this).prev('input').val();

        $.ajax({
            url: "{{ route('addToCart') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#cart-count').text(response.totalItems);
                    alert('Sản phẩm đã được thêm vào giỏ hàng');
                } else {
                    alert(response.message);
                }
            }
        });
    });
});
</script>
@endsection
