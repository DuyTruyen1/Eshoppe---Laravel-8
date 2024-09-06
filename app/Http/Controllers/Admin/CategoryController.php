<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CatergoryRequest;

class CategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Retrieve all categories
        $categories = Category::all();
    
        // Pass categories to the view
        return view('Admin.Category.category', ['categories' => $categories]);
    }
    

    public function add(){
        $categoryList = Category::all();
        return view('Admin.Category.add',compact('categoryList'));
    }

    public function insert(Request $request){
        $dataInsert = $request->only('name');
        Category::create($dataInsert); 
        return redirect()->route('Category.category');

     }

     public function getEdit(Request $request,$id = 0){
        if(!empty($id)){
            $categoryDetail = Category::find($id);
            if($categoryDetail){
                $request->session()->put('id',$id);
            }else{
                $mgs = 'ID người dùng không tồn tại ';
            }
        }else{
            $mgs = 'ID người dùng không hợp lệ ';
        }
        return view('Admin.Category.edit',compact('categoryDetail'));
     }
     

     public function updateCategory(CatergoryRequest $request) {
         $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
    
        $category = Category::findOrFail($id);
    
        $data = $request->validated();
    
        // Cập nhật bản ghi
        if($category->update($data)){
            return redirect()->back()->with('success',__('Cập nhật thành công'));
        }else{
            return redirect()->back()->with('error',__('Cập nhật thất bại'));
        }
    }
    

     public function delete($id = 0){
        $title = 'Xóa Danh Mục';
        $msg = '';
        if(!empty($id)){
            $category = Category::find($id); // Sử dụng Eloquent để tìm cầu thủ cần xóa
            if($category){
               $deleteStatus = $category->delete(); // Xóa cầu thủ
               if($deleteStatus){
                $msg = 'Xoá danh mụcthành công';
               }else{
                $msg = 'Không thể xoá ';
               }
            }else{
               $msg = 'ID danh mục không tồn tại';
            }
        } else {
            $msg = 'ID danh mục không hợp lệ ';
        }
    }

}
