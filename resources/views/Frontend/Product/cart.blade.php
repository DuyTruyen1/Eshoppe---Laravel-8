{{-- resources/views/Frontend/Product/cart.blade.php --}}
@extends('Frontend.layouts.app2')
@section('noidung')
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
                                <p class="cart_total_price" data-id="{{ $item['id']}}">${{ $totalItemPrice }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" data-id="{{ $item['id']}} href="><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>${{ $totalCartPrice }}</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{ $totalCartPrice + 2}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
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
            url: "{{ route('updateCart') }}",
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

        updateTotal();

        console.log('Cập nhật giỏ hàng thành công');
    } else {
        alert('Error: ' + response.message);
    }
}
,
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
