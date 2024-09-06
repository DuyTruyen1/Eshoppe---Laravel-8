@extends('Frontend.layouts.app2')

<style>
    .table-orange {
        background-color: white;
    }

    .table-orange th,
    .table-orange td {
        border-color: rgb(148, 145, 140);
    }
</style>
@section('noidung')
<div class="container">
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Account</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('account.menu') }}">account</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('account.myProduct') }}">My product</a></h4>
                    </div>
                </div>
                
            </div><!--/category-products-->
        </div>
    </div>
    <div class="col-sm-9">
        <div class="table-responsive cart_info">
            <table class="table table-bordered table-orange">
                <thead>
                    <tr class="cart_menu">
                        <td class="id">Id</td>
                        <td class="description">Name</td>
                        <td class="image">Image</td>
                        <td class="price">Price</td>
                        <td class="total">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="cart_description">
                            <h4><a href="#">{{ $product->id }}</a></h4>
                        </td>
                        
                        <td class="cart_name">
                            <h4><a href="#">{{ $product->name }}</a></h4>
                        </td>
                        <td class="cart_image">
                            <h4><a href="#">{{ $product->hinhanh }}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>${{ $product->price }}</p>
                        </td>
                        <td class="cart_total">
                            <a class="btn btn-primary" href="{{route('product.edit',['id'=>$product->id])}}">Edit</a>
                            <a onclick="return confirm('Có chắc chắn muốn xoá?')"
                             class="btn btn-primary" href="{{route('delete',['id'=>$product->id])}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-center">
                            <a class="btn btn-primary" href="{{route('add-product')}}">Add</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</div>
@endsection
