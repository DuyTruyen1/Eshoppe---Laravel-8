@extends('Frontend.layouts.app1')
@section('noidung')
<div class="col-sm-9">
   <div class="blog-post-area" style="font-size: 12px;">
      <div class="single-blog-post">
         <h3>{{ $blog->title }}</h3>
         <div class="post-meta">
            <ul>
               <li><i class="fa fa-user"></i> {{ $blog->author }}</li>
               <li><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('h:i a') }}</li>
               <li><i class="fa fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</li>
            </ul>
         </div>
         <img src="{{ asset('Admin/upload/blog/image/' . $blog->image) }}" alt="" width="600" height="400">
         <p>{{ $blog->content }}</p>
      </div>
      
      <div class="pager-area">
         <ul class="pager pull-left">
            @if ($prevBlog)
            <li><a href="{{ route('blog.show', ['id' => $prevBlog->id]) }}">Prev</a></li>
            @endif
         </ul>
         <ul class="pager pull-right">
            @if ($nextBlog)
            <li><a href="{{ route('blog.show', ['id' => $nextBlog->id]) }}">Next</a></li>
            @endif
         </ul>
      </div>
      <div class="rating-area">
         <ul class="ratings">
            <li class="rate-this">Rate this item:</li>
            <li class="rate">
               <div class="star star_1 ratings_stars" data-value="1"></div>
               <div class="star star_2 ratings_stars" data-value="2"></div>
               <div class="star star_3 ratings_stars" data-value="3"></div>
               <div class="star star_4 ratings_stars" data-value="4"></div>
               <div class="star star_5 ratings_stars" data-value="5"></div>
               <span class="rate-np">{{ $roundedRate }}</span> <!-- Hiển thị điểm trung bình -->
            </li>
            <li class="color">({{ $rates->count() }} votes)</li>
         </ul>
      </div>
      <div class="tag-area">
         <ul class="tag" style="list-style: none; padding: 0;">
            <li style="display: inline-block;">TAG:</li>
            <li style="display: inline-block;"><a class="color" href="">Pink <span>/</span></a></li>
            <li style="display: inline-block;"><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li style="display: inline-block;"><a class="color" href="">Girls</a></li>
         </ul>
      </div>

      <div class="socials-share">
         <a href=""><img src="{{ asset('Frontend/images/blog/socials.png') }}" alt=""></a>
      </div>

      {{-- phần hiển thị bình luận --}}
      @if($comments->isNotEmpty())
    <div class="media comments">
    <a class="pull-left" href="#">
        <img class="media-object" src="{{ asset('Frontend/upload/user/avatar/' . $comments[0]->avatar_user) }}" alt="{{ $comments[0]->name_user }} " width="200" height="200">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{ $comments[0]->name_user }}</h4>
        <p>{{ $comments[0]->cmt }}</p>
        <!-- Phần social và nút "Other Posts" -->
        <div class="blog-socials">
            <ul>
                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                <li><a href=""><i class="fa fa-google-plus"></i></a></li>
            </ul>
            <a class="btn btn-primary" href="">Other Posts</a>
        </div>
    </div>
</div>
@endif


       <div class="response-area">
         <h2>{{ $comments->count() }} RESPONSES</h2>
         <ul class="media-list">
            @foreach($comments as $comment)
            <li class="media">
               <a class="pull-left" href="#">
                <img class="media-object" src="{{ asset('Frontend/upload/user/avatar/' . $comment->avatar_user) }}" alt="{{ $comment->name_user }}" width="200" height="100">
                </a>
               <div class="media-body">
                  <ul class="sinlge-post-meta">
                     <li><i class="fa fa-user"></i> {{ $comment->name_user }}</li>
                     <li><i class="fa fa-clock-o"></i> {{ $comment->created_at->format('h:i a') }}</li>
                     <li><i class="fa fa-calendar"></i> {{ $comment->created_at->format('M d, Y') }}</li>

                  </ul>
                  <p>{{ $comment->cmt }}</p>
                  <a class="btn btn-primary reply-btn" href="#" data-comment-id="{{ $comment->id }}">Reply</a>
                  @if($comment->replies && $comment->replies->count() > 0)
                  <div class="replies">
                     <h3>Replies:</h3>
                     <ul>
                        @foreach($comment->id_user as $reply)
                        <li>
                            <div class="reply">
                                <img src="{{ $reply->image }}" alt="Avatar">
                                <p>{{ $reply->cmt }}</p>
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i> {{ $reply->name_user }}</li>
                                    <li><i class="fa fa-clock-o"></i> {{ $reply->created_at->format('h:i a') }}</li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                     </ul>
                  </div>
                  @endif
               </div>
            </li>
            @endforeach
         </ul>
      </div> 
      <!--/Response-area--> 

      
      <!-- Reply box for this comment -->
      <div class="replay-box">
         <div class="row">
            <div class="col-sm-12">
               <h2>Leave a reply</h2>
               <form action="{{ route('postComment', ['id' => $blog->id]) }}" method="POST">
                  @csrf
                  <div class="text-area">
                     <div class="blank-arrow">
                        <label>Your Name</label>
                     </div>
                     <span>*</span>
                     <textarea name="cmt" rows="11" required></textarea>
                     <input type="hidden" name="level" value="0" />
                     <button type="submit" class="btn btn-primary">Post Comment</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
@endsection
@section('js')
<script src="{{ asset('Frontend/js/jquery-1.9.1.min.js') }}"></script>
<script>
   $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Xử lý sự kiện hover trên các ngôi sao đánh giá
    $('.ratings_stars').hover(
        function() {
            $(this).prevAll().addBack().addClass('ratings_hover');
        },
        function() {
            $(this).prevAll().addBack().removeClass('ratings_hover');
        }
    );

    // Xử lý sự kiện click trên các ngôi sao đánh giá
    $('.ratings_stars').click(function() {
        var checkLogin = "{{ Auth::check() }}";

        if (checkLogin) {
            var rate = $(this).data('value');
            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).nextAll().removeClass('ratings_vote');
            } else {
                $(this).prevAll().addBack().addClass('ratings_over');
            }

            var blogId = "{{ $blog->id }}";

            $.ajax({
                type: 'POST',
                url: '{{ url("/blog/rate/ajax") }}',
                data: {
                    rate: rate,
                    blog_id: blogId
                },
                success: function(data) {
                    console.log(data.success);
                    $('.rate-np').text(data.averageRating);
                    var roundedRating = Math.round(data.averageRating);
                    $('.ratings_stars').removeClass('checked');
                    $('.ratings_stars:lt(' + roundedRating + ')').addClass('checked');
                }
            });
        } else {
            alert("Vui lòng đăng nhập để đánh giá.");
        }
    });

    // Xử lý sự kiện click trên nút "Reply"
    $('.reply-btn').click(function(event) {
        event.preventDefault();
        var commentId = $(this).data('comment-id');
        $('input[name="level"]').val(commentId); // Gán giá trị của id bình luận vào input "level"
    });

    // Xử lý sự kiện submit form bình luận
    $('form').submit(function(event) {
        event.preventDefault();

        var checkLogin = "{{ Auth::check() }}";
        if (checkLogin) {
            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Bình luận đã được đăng thành công!');
                        // Có thể thực hiện các thao tác cập nhật giao diện sau khi bình luận thành công
                    } else {
                        alert('Không thể đăng bình luận.');
                    }
                }
            });
        } else {
            alert("Vui lòng đăng nhập để bình luận.");
        }
    });
});


</script>
@endsection