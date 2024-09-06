@extends('Frontend.layouts.app1')
@section('noidung')
<div class="col-sm-4">
    <div class="login-form">
        <h2>Login!</h2>
        {{-- Kiểm tra nếu có lỗi xảy ra --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Hiển thị form đăng nhập --}}
        <form action="{{ route('frontend.login') }}" method="POST" enctype="multipart/form-data">
            {{-- nhớ phải thêm csrf ở dưới --}}
            @csrf

            <div class="col-12">   
                <label class="col-md-12">Email</label>   
                <input type="text" id="email" name="email" class="form-control form-control-line" placeholder="Email">
            </div>

            <div class="col-12">   
                <label>Password</label>   
                <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-line"/>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Đăng Nhập</button>
            </div>
        </form>
    </div>
</div>
@endsection
