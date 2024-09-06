@extends('Frontend.layouts.app1')

@section('noidung')
<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">                
            <div class="view-product">
                <a href="{{ asset('upload/product/' . $hinhanh[0]) }}" rel="prettyPhoto">
                    <img id="main-image" src="{{ asset('upload/product/' . $hinhanh[0]) }}" alt="" />
                </a>
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            @foreach($hinhanh as $image)
                            <div class="col-xs-4">
                                <a href="{{ asset('upload/product/' . $image) }}" rel="prettyPhoto">
                                    <img src="{{ asset('upload/product/' . $image) }}" alt="" width="100px">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Additional slides if necessary -->
                </div>
                <!-- Controls -->
                <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="{{ asset('Frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                <h2>{{ $product->name }}</h2>
                <p>Web ID: {{ $product->id }}</p>
                <img src="{{ asset('Frontend/images/product-details/rating.png') }}" alt="" />
                <span>
                    <span>{{ $product->price }}</span>
                    <label>Quantity:</label>
                    <input type="text" value="1" id="quantity" />
                    <button type="button" class="btn btn-fefault cart" id="add-to-cart" data-product-id="{{ $product->id }}">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
                <p><b>Availability:</b> {{ $product->status ? 'In Stock' : 'Out of Stock' }}</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ $product->id_brand }}</p>
                <a href=""><img src="{{ asset('Frontend/images/product-details/share.png') }}" class="share img-responsive" alt="" /></a>
            </div>
        </div>
    </div><!--/product-details-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
    $(document).ready(function() {    
        $('#similar-product .item img').click(function() {
    var imageSrc = $(this).attr('src');
    $('#main-image').attr('src', imageSrc);
    return false;
});

        $('#add-to-cart').click(function() {
            var productId = $(this).data('product-id');
            var quantity = $('#quantity').val();

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
                        alert('Sản phẩm được thêm vào giỏ hàng');
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
@endsection
