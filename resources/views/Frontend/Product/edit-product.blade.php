@extends('Frontend.layouts.app2')
@section('noidung')
<div class="container">
<div class="col-sm-3">
   <div class="left-sidebar">
      <h2>Account</h2>
      <div class="panel-group category-products" id="accordian">
         <!--category-productsr-->
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
      </div>
      <!--/category-products-->
   </div>
</div>
<div class="col-sm-9">
   <div class="blog-post-area">
      <h2 class="title text-center">Edit Product</h2>
      <div class="signup-form">
         <h2>Edit Product</h2>
         <form class="form-horizontal form-material" method="POST" action="{{ route('update', ['id' => $product->id]) }}" enctype="multipart/form-data">
            @csrf
            <!-- Name -->
            <div class="form-group">
               <label class="col-md-12">Name</label>
               <div class="col-md-12">
                  <input type="text" id="name" name="name" placeholder="Product Name" class="form-control form-control-line" value="{{ $product->name }}">
               </div>
            </div>
            <!-- Price -->
            <div class="form-group">
               <label class="col-md-12">Price</label>
               <div class="col-md-12">
                  <input type="text" id="price" name="price" placeholder="$" class="form-control form-control-line" value="{{ $product->price }}">
               </div>
            </div>
            <!-- Category -->
            <div class="form-group">
               <label class="col-md-12">Category</label>
               <div class="col-md-12">
                  <select id="category_id" name="category_id" class="form-control form-control-line">
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                  </select>
               </div>
            </div>
            <!-- Brand -->
            <div class="form-group">
               <label class="col-md-12">Brand</label>
               <div class="col-md-12">
                  <select id="brand_id" name="brand_id" class="form-control form-control-line">
                  @foreach($brands as $brand)
                  <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                  @endforeach
                  </select>
               </div>
            </div>
            <!-- Status -->
            <div class="form-group">
               <label class="col-md-12">Status</label>
               <div class="col-md-12">
                  <select id="status" name="status" class="form-control form-control-line">
                  <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                  <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                  </select>
               </div>
            </div>
            <!-- Sale -->
            <div class="form-group">
               <label class="col-md-12">Sale</label>
               <div class="col-md-12">
                  <select id="sale" name="sale" class="form-control form-control-line" onchange="toggleSalePrice(this.value)">
                  <option value="0" {{ $product->sale == 0 ? 'selected' : '' }}>New</option>
                  <option value="1" {{ $product->sale == 1 ? 'selected' : '' }}>Sale</option>
                  </select>
               </div>
            </div>
            <!-- Sale Price -->
            <div class="form-group" id="salePriceDiv" style="display: none;">
               <label class="col-md-12">Sale Price</label>
               <div class="col-md-12">
                  <input type="text" id="salePrice" name="salePrice" class="form-control form-control-line" placeholder="Enter sale price" value="{{ $product->sale_price }}">
               </div>
            </div>
            <!-- Company -->
            <div class="form-group">
               <label class="col-md-12">Company</label>
               <div class="col-md-12">
                  <input type="text" id="company" name="company" class="form-control form-control-line" value="{{ $product->company }}">
               </div>
            </div>
            <!-- Image -->
            <div class="form-group">
               <label class="col-md-12">Image</label>
               <div class="col-md-12">
                  <input type="file" id="image" name="image[]" multiple class="form-control form-control-line">
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-12">Ảnh chỉnh sửa</label>
               <div class="col-md-12">
                  @php
                  $Images = json_decode($product->hinhanh, true);
                  @endphp
                  @if ($Images)
                  @foreach($Images as $image)
                  <div class="checkbox">
                     <label>
                     <input type="checkbox" name="delete_images[]" value="{{ $image }}">
                     </label>
                     <img src="{{ asset('upload/product/' . $image) }}" alt="Product Image" width="100px">
                     @endforeach
                     @else
                     <p>Ảnh không tồn tại</p>
                     @endif
                  </div>
               </div>
               <!-- Detail -->
               <div class="form-group">
                  <label class="col-md-12">Detail</label>
                  <div class="col-md-12">
                     <textarea id="detail" name="detail" class="form-control form-control-line" rows="4" placeholder="Enter details here...">{{ $product->detail }}</textarea>
                  </div>
               </div>
               <!-- Submit Button -->
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
<style>
   .image-container {
   display: flex;
   flex-wrap: wrap;
   }
   .image-item {
   flex: 0 0 auto;
   width: 33.33%; /* Điều chỉnh độ rộng của mỗi hình ảnh (nếu bạn muốn 3 hình ảnh trong một hàng) */
   padding: 10px;
   }
   .image-item img {
   max-width: 100%;
   height: auto;
   }
</style>
@endsection