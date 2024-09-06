@extends('Frontend.layouts.app1')
@section('noidung')
<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form  action="{{ route('frontend.register') }}" method="POST" enctype="multipart/form-data">
            {{-- nhớ phải thêm csrf ở dưới --}}
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
@endsection
