@extends('Admin.layouts.app')
@section('content')
<div class="page-wrapper">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Blog Management</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- List Country -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> List of Countries</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">title</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Content</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop through countries and display them here -->

                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->image }}</td>
                                        <td>{{ $blog->description }}</td>
                                        <td>{{ $blog->content }}</td>

                                        <td>
                                            <a href="{{route('Blogs.editBlog',['id'=>$blog->id])}}" class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        <td>
                                            
                                            <a onclick="return confirm('Có chắc chắn muốn xoá?')"
                                             href="{{route('Blogs.delete',['id'=>$blog->id])}}" class="btn btn-warning btn-sm">Xoá</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End List Country -->
        <!-- Add Country -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-2-box-outline"></i> Edit Blog</h6>
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Blog Name:</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <a href="{{ route('Blogs.addBlog') }}" class="btn btn-primary">Thêm Blog</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Country -->
    </div>
    <!-- End Container fluid  -->
    <!-- Footer -->
    <footer class="footer text-center">
        All Rights Reserved by Nice admin. Designed and Developed by
        <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- End Footer -->
</div>
@endsection
