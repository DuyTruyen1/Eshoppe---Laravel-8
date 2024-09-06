@extends('Frontend.layouts.app2')
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
        <div class="blog-post-area">
            <h2 class="title text-center">Create Product</h2>
             <div class="signup-form">
            <h2>Create Product</h2>
            <form class="form-horizontal form-material" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
            
                <div class="form-group">
                    <label class="col-md-12">Name</label>
                    <div class="col-md-12">
                        <input type="text" id="name" name="name" placeholder="Product Name" class="form-control form-control-line" value="{{ old('name') }}">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Price</label>
                    <div class="col-md-12">
                        <input type="text" id="price" name="price" placeholder="$" class="form-control form-control-line" value="{{ old('price') }}">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Category</label>
                    <div class="col-md-12">
                        <select id="category_id" name="category_id" class="form-control form-control-line">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Brand</label>
                    <div class="col-md-12">
                        <select id="brand_id" name="brand_id" class="form-control form-control-line">
                            @foreach($brand as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Status</label>
                    <div class="col-md-12">
                        <select id="status" name="status" class="form-control form-control-line">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Sale</label>
                    <div class="col-md-12">
                        <select id="sale" name="sale" class="form-control form-control-line" onchange="toggleSalePrice(this.value)">
                            <option value="0">New</option>
                            <option value="1">Sale</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="salePriceDiv" style="display: none;">
                    <label class="col-md-12">Sale Price</label>
                    <div class="col-md-12">
                        <input type="text" id="salePrice" name="salePrice" class="form-control form-control-line" placeholder="Enter sale price">
                    </div>
                </div>
            
                <div class="form-group" id="sale-price-group" style="display: none;">
                    <label class="col-md-12">Sale Price</label>
                    <div class="col-md-12">
                        <input type="text" id="sale_price" name="sale_price" placeholder="$" class="form-control form-control-line" value="{{ old('sale_price') }}">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Company</label>
                    <div class="col-md-12">
                        <input type="text" id="company" name="company" class="form-control form-control-line" value="{{ old('company') }}">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Select files</label>
                    <div class="col-md-12">
                        <input type="file" id="image" name="image[]" multiple class="form-control form-control-line" >
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Detail</label>
                    <div class="col-md-12">
                        <textarea id="detail" name="detail" class="form-control form-control-line" rows="4" placeholder="Enter details here...">{{ old('detail') }}</textarea>
                    </div>
                </div>
            
                <div class="form-group"> 
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
            
            <script>
                function toggleSalePrice(value) {
                    if (value == 1) {
                        document.getElementById('sale-price-group').style.display = 'block';
                    } else {
                        document.getElementById('sale-price-group').style.display = 'none';
                    }
                }
            </script>
            
            
        </div>
        </div>
    </div>
</div>
@endsection