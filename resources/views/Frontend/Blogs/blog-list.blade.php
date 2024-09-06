@extends('Frontend.layouts.app1')
@section('noidung')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        @foreach($blogs as $blog)
        <div class="single-blog-post">
            <h3>{{ $blog->title }}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> {{ $blog->author }}</li>
                    <li><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('h:i a') }}</li>
                    <li><i class="fa fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</li>
                </ul>
            </div>

            <a href="">
                <img src="{{asset('Admin/upload/blog/image/' . $blog->image) }}" alt="">
            </a>
            <p>{{ $blog->description }}</p>
            <a class="btn btn-primary" href="{{ route('blog.show', $blog->id) }}">Read More</a>
        </div>
        @endforeach
        <div class="pagination-area">
            {!! $blogs->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection
