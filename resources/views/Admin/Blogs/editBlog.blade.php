@extends('Admin.layouts.app')
@section('content')
<div class="page-wrapper">
    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Edit Blog</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
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

                    <form class="form-horizontal m-t-30" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title<span class="help"></span></label>
                            <input type="text" id="title" name="title" class="form-control"
                             placeholder="Tiêu đề" value="{{ old('title') }}" >
                             @error('title')
                            <span style="color: red;">{{ $message }}</span>
                             @enderror
                        </div> 
                        
                        <div class="form-group" >
                            <label>Image<span class="help"></span></label>
                            <input type="file" id="image" name="image" class="form-control"
                             placeholder="Hình ảnh" >
                             @error('image')
                            <span style="color: red;">{{ $message }}</span>
                             @enderror
                        </div> 

                        <div class="form-group">
                            <label>Description<span class="help"></span></label>
                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description"></textarea>
                            @error('description')
                            <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Content<span class="help"></span></label>
                            <textarea id="content" name="content" class="form-control" rows="3" placeholder="Nội dung"></textarea>
                            @error('content')
                            <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        

                        <div>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="{{ route('Blogs.blog') }}" class="btn btn-primary">Quay Lại</a>

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
<!-- CDN của CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>

{{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
<script>
    // CKEditor script
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
