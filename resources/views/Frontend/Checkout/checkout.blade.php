@extends('Frontend.layouts.app2')
@section('noidung')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Check out</li>
    </ol>
</div><!--/breadcrums-->

<div class="step-one">
    <h2 class="heading">Step1</h2>
</div>

<div class="checkout-options">
    <h3>New User</h3>
    <p>Checkout options</p>
    <ul class="nav">
        <li>
            <label><input type="checkbox"> Register Account</label>
        </li>
        <li>
            <label><input type="checkbox"> Guest Checkout</label>
        </li>
        <li>
            <a href=""><i class="fa fa-times"></i>Cancel</a>
        </li>
    </ul>
</div><!--/checkout-options-->

<div class="register-req">
    <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
</div><!--/register-req-->

<div class="shopper-informations">
    <div class="row">
        <div class="col-sm-3">
            <div class="shopper-info">
                <form action="{{ route('frontend.order') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Order</button>
                </form>
            </div>
        </div>
        
        @guest
        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->
                <h2>New User Signup!</h2>
                <form action="{{ route('frontend.register-order') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-12">   
                        <label class="col-md-12">Name</label>   
                        <input type="text" id="name" name="name" class="form-control form-control-line" placeholder="Name">
                    </div>
                    
                    <div class="col-12">   
                        <label>Email</label>   
                        <input type="text" id="email" name="email" placeholder="Email" class="form-control form-control-line"/>
                    </div>

                    <div class="col-12">   
                        <label>Password</label>   
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-line"/>
                    </div>

                    <div class="col-12">   
                        <label>Phone No</label>   
                        <input type="text" id="phone" name="phone" placeholder="Phone" class="form-control form-control-line"/>
                    </div>

                    <div class="col-12">   
                        <label>Address</label>   
                        <input type="text" id="address" name="address" placeholder="Address" class="form-control form-control-line"/>
                    </div>

                    <div class="col-12">   
                        <label>Id_country</label>   
                        <input type="text" id="id_country" name="id_country" placeholder="Id_country" class="form-control form-control-line"/>
                    </div>

                    <div class="col-12">
                        <label for="avatar">Avatar</label>
                        <input type="file" id="avatar" name="avatar" class="form-control form-control-line">
                    </div>

                    <div class="col-12">
                        <label>Select Country</label>
                        <select name="id_country" class="form-control form-control-line">
                            <option value="1">London</option>
                            <option value="2">India</option>
                            <option value="3">USA</option>
                            <option value="4">Canada</option>
                            <option value="5">Thailand</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Sign Up</button>
                    </div>
                </form>
            </div><!--/sign up form-->
        </div>
        @endguest
        
        @auth
        <div class="col-sm-4">
            <p>Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        @endauth					
    </div>
</div>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalCartPrice = 0;
                    @endphp
                    @foreach($cartItems as $item)
                        @php
                            $totalItemPrice = $item['price'] * $item['quantity'];
                            $totalCartPrice += $totalItemPrice;
                        @endphp
                        <tr data-id="{{ $item['id'] }}"> 
                            <td class="cart_product">
                                {{-- Hiển thị hình ảnh sản phẩm --}}
                                @if (!empty($item['hinhanh']))
                                    @foreach ($item['hinhanh'] as $image)
                                        <a href="#"><img src="{{ asset('upload/product/' . $image) }}" alt="" width="100px"></a>
                                        @break
                                    @endforeach
                                @else
                                    <a href="#"><img src="{{ asset('upload/product/default.jpg') }}" alt=""></a>
                                @endif
                            </td>
                            <td class="cart_description">
                                <h4><a href="#">{{ $item['name'] }}</a></h4>
                                <p>Web ID: {{ $item['id'] }}</p>
                            </td>
                            <td class="cart_price">
                                <p>${{ $item['price'] }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" data-id="{{ $item['id']}}" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" data-id="{{ $item['id']}}" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{ $totalItemPrice }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" data-id="{{ $item['id']}}" href="#"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                    <table class="table table-condensed total-result">
                        <tr>
                            <td>Cart Sub Total</td>
                            <td>${{ $totalCartPrice }}</td>
                        </tr>
                        <tr>
                            <td>Exo Tax</td>
                            <td>$2</td>
                        </tr>
                        <tr class="shipping-cost">
                            <td>Shipping Cost</td>
                            <td>Free</td>										
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><span>${{ $totalCartPrice + 2 }}</span></td>
                        </tr>
                    </table>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
    $(document).on('click', '.cart_quantity_up', function(event) {
        event.preventDefault();
        var row = $(this).closest('tr');
        var productId = row.data('id');
        var quantityInput = row.find('.cart_quantity_input');
        var currentQuantity = parseInt(quantityInput.val());
        var newQuantity = currentQuantity + 1;
        updateCart(productId, newQuantity, row);
    });

    $(document).on('click', '.cart_quantity_down', function(event) {
        event.preventDefault();
        var row = $(this).closest('tr');
        var productId = row.data('id');
        var quantityInput = row.find('.cart_quantity_input');
        var currentQuantity = parseInt(quantityInput.val());
        if (currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
            updateCart(productId, newQuantity, row);
        }
    });

    $(document).on('click', '.cart_quantity_delete', function(event) {
        event.preventDefault();
        var row = $(this).closest('tr');
        var productId = row.data('id');
        updateCart(productId, 0, row);
    });

    function updateCart(productId, quantity, row) {
        $.ajax({
            url: "{{ route('updateCartCheckout') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
    if (response.status === 'success') {
        if (quantity === 0) {
            row.remove();
        } else {
            row.find('.cart_quantity_input').val(quantity);
            row.find('.cart_total_price').text('$' + response.totalItemPrice.toFixed(2));
        }
        $('.cart_total_price[data-id="' + productId + '"]').text('$' + response.totalItemPrice.toFixed(2));

        // updateTotal();

        console.log('Cập nhật giỏ hàng thành công');
    } else {
        alert('Error: ' + response.message);
    }
},
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
                alert('Có lỗi trong quá trình cập nhật giỏ hàng');
            }
        });
    }

         function updateTotal() {
                 var total = 0;
                 $(".cart_total_price").each(function () {
                     var priceText = $(this).text().replace("$", "");
                     var price = parseFloat(priceText);
                     if (!isNaN(price)) {
                         total += price;
                     }
                 });
                 $(".total_area span:last").text("$" + total.toFixed(2));
             }
});
</script>

@endsection
