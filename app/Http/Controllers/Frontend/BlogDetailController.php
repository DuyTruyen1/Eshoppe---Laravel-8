<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;



class BlogDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('Frontend.Blogs.blog-detail-2');
    }

    public function show($id)
{
    $blog = Blog::findOrFail($id);
    $prevBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first(); 
    $nextBlog = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first(); 

    // Lấy tất cả đánh giá của blog
    $rates = Rate::where('blog_id', $id)->get();

    // Tính điểm trung bình
    $averageRate = $rates->avg('rate');
    $comments = Comment::where('id_blog', $id)->orderBy('created_at', 'desc')->get(); 

    // Làm tròn điểm số (nếu cần)
    $roundedRate = round($averageRate);

    return view('frontend.Blogs.blog-detail-2', compact('blog', 'prevBlog', 'nextBlog', 'roundedRate', 'rates','comments'));
}
    
    public function rateBlog(Request $request)
    {
        $data = $request->all();
        $rate = $data['rate'];
        $blogId = $data['blog_id'];
    
        Rate::create([
            'rate' => $rate,
            'user_id' => auth()->id(),
            'blog_id' => $blogId,
        ]);
    
        $averageRating = Rate::where('blog_id', $blogId)->avg('rate');
    
        return response()->json(['averageRating' => $averageRating]);
    }


    // public function comment(Request $request, $id)
    // {
    //     // Lấy ID của người dùng hiện đang đăng nhập
    //     $user = Auth::user();
        
    //     $comment = new Comment;
    //     $comment->cmt = $request->input('cmt');
    //     $comment->id_user = $user->id; 
    //     $comment->id_blog = $id; 
    //     $comment->name_user = $user->name; 
    //     $comment->avatar_user = $user->avatar;
    //     $comment->level = $request->input('level');
    
    //     $comment->save();
    
    //     return response()->json(['success' => true]);
    // }


    public function comment(Request $request, $id)
    {
        $user = Auth::user();
    
        $data = $request->all();
        $cmt = $data['cmt'];
        $blogId = $id;
    
        $level = 0;
    
        // Kiểm tra xem cmt cha của bình luận có tồn tại hay không
        $cmtCha = Comment::find($data['level']);
        if ($cmtCha && $cmtCha->level != 0) {
            $level = $cmtCha->level;
        } else {
            // Nếu không, thì  cmt con để gán cho level
            $level = $data['level'];
        }
    
        // Tạo bình luận mới
        $comment = Comment::create([
            'cmt' => $cmt,
            'id_user' => auth()->id(),
            'id_blog' => $blogId,
            'avatar_user' => $user->avatar,
            'name_user' => $user->name, 
            'level' => isset($data['reply-box']) ? $data['reply-box'] : $level
        ]);
    
        // Trả về dữ liệu của bình luận mới tạo
        return response()->json([
            'success' => true,
            'cmt' => $comment->cmt,
            'name_user' => auth()->user()->name,
            'avatar_user' => $comment->avatar_user,
            'created_at_time' => $comment->created_at->format('h:i a'),
            'created_at_date' => $comment->created_at->format('M d, Y'),
            'comment_id' => $comment->id,
        ]);
    }
    
    
}
