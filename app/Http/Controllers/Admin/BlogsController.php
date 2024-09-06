<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Blog;
use App\Http\Requests\UpdateBlogsRequest;


class BlogsController extends Controller
{
    private $blog;
    public function __construct()
    {
        $this->blog = new Blog(); 

        $this->middleware('auth');
    }

    public function index(){
        $blogs  = Blog::all();
        return view('Admin.Blogs.blog',compact('blogs'));
    }

    public function addBlog(){
        $blogList = Blog::all();
        return view('Admin.Blogs.addBlog',compact('blogList'));
    }

   
    public function insert(Request $request){
        $dataInsert = $request->only('title', 'image', 'description', 'content');
        Blog::create($dataInsert); 
        return redirect()->route('Blogs.blog');
     }

     public function getEdit(Request $request,$id = 0){
        if(!empty($id)){
            $blogDetail = Blog::find($id);
            if($blogDetail){
                $request->session()->put('id',$id);
            }else{
                $mgs = 'ID người dùng không tồn tại ';
            }
        }else{
            $mgs = 'ID người dùng không hợp lệ ';
        }
        return view('Admin.Blogs.editBlog',compact('blogDetail'));
     }
     

     public function updateBlog(UpdateBlogsRequest $request) {
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
    
        $blog = Blog::findOrFail($id);
    
        $data = $request->validated();
    
        // Check if a file has been uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    
            $data['image'] = $file->getClientOriginalName();
    
            $file->move('Admin/upload/blog/image', $file->getClientOriginalName());
        }
    
        // Update the record
        if($blog->update($data)){
            return redirect()->back()->with('success',__('Cập nhật thành công'));
        } else {
            return redirect()->back()->with('error',__('Cập nhật thất bại'));
        }
    }
    


   public function delete($id = 0){
    $title = 'Xóa Người Dùng';
    $msg = '';
    if(!empty($id)){
        $blog = Blog::find($id); // Sử dụng Eloquent để tìm cầu thủ cần xóa
        if($blog){
           $deleteStatus = $blog->delete(); // Xóa cầu thủ
           if($deleteStatus){
            $msg = 'Xoá người dùng thành công';
           }else{
            $msg = 'Không thể xoá ';
           }
        }else{
           $msg = 'ID người dùng không tồn tại';
        }
    } else {
        $msg = 'ID người dùng không hợp lệ ';
    }
}
}
