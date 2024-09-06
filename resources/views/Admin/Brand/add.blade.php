@extends('Admin.layouts.app')
@section('content')
<div class="page-wrapper">
    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Add Brand</h4>
                @if(session('msg'))
                <div class="alert alert-success mt-3">
                    {{ session('msg') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger mt-3">
                    Dữ liệu nhập vào không hợp lệ
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
  
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-12">
                <div class="card card-body">

                    <form class="form-horizontal m-t-30" action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name <span class="help"></span></label>
                            <input type="text" id="name" name="name" class="form-control"
                             placeholder="Tên Thương Hiệu" value="{{ old('name') }}" >
                             @error('name')
                            <span style="color: red;">{{ $message }}</span>
                             @enderror
                        </div>  
                        <div>
                            <button type="submit" class="btn btn-primary"> Thêm Mới</button>
                            <a href="{{ route('Brand.brand') }}" class="btn btn-primary">Quay Lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       
    </div>
   
    <footer class="footer text-center">
        All Rights Reserved by Nice admin. Designed and Developed by
        <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
   
</div>
@endsection
