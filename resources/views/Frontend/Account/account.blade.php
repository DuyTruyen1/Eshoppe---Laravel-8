@extends('Frontend.layouts.app2')
@section('noidung')
<section>
    <div class="container">
        <div class="row">
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
                    <h2 class="title text-center">Update user</h2>
                     <div class="signup-form"><!--sign up form-->
                    <h2>Update User</h2>
                    <form class="form-horizontal form-material" method="POST" action="{{ route('account.updateProfile') }}"  enctype="multipart/form-data">
                        {{-- nhớ phải thêm csrf ở dưới --}}
                          @csrf
                         
                          <div class="form-group">
                              <label class="col-md-12">Full Name</label>
                              <div class="col-md-12">
                                  <input type="text" id="name" name="name" placeholder="Johnathan Doe" class="form-control form-control-line" value="{{ $user->name }}" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="example-email" class="col-md-12">Email</label>
                              <div class="col-md-12">
                                  <input type="email" id="email" name="email" 
                                  placeholder="johnathan@admin.com" class="form-control form-control-line" value="{{ $user->email }}" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-12">Password</label>
                              <div class="col-md-12">
                                  <input type="password" id="password" name="password" value="password" class="form-control form-control-line">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-12">Phone No</label>
                              <div class="col-md-12">
                                  <input type="text" id="phone" name="phone"  class="form-control form-control-line" value="{{ $user->phone }}" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-12">Address</label>
                              <div class="col-md-12">
                                  <input type="text" id="address" name="address"  class="form-control form-control-line" value="{{ $user->address }}" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-12">id_country</label>
                              <div class="col-md-12">
                                  <input type="text" id="id_country" name="id_country"  class="form-control form-control-line" value="{{ $user->id_country }}" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-12" for="avatar">Avatar</label>
                              <div class="col-md-12">
                                  <input type="file" id="avatar" name="avatar" class="form-control form-control-line">
                              </div>
                          </div>
                          <div class="form-group"> 
                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-success">Update Profile</button>
                              </div>          
                        </div>
                      </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection