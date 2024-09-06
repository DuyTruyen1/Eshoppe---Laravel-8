<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\CatergoryRequest;
use Illuminate\Support\Facades\Auth;



class BrandController extends Controller
{

    public function index()
    {
        $Brands = Brand::all();
    
        // return view('Admin.Brand.brand', ['brands' => $Brands]);
        return response()->json([
            'brand' => $Brands
        ]);
    }
    

    public function add(){
        $brandList = Brand::all();
        return view('Admin.Brand.add',compact('brandList'));
    }

    public function insert(Request $request){
        $dataInsert = $request->only('name');
        Brand::create($dataInsert); 
        return redirect()->route('Brand.brand');

     }

     public function getEdit(Request $request,$id = 0){
        if(!empty($id)){
            $brandDetail = Brand::find($id);
            if($brandDetail){
                $request->session()->put('id',$id);
            }else{
                $mgs = 'ID thương hiệu danh mục không tồn tại ';
            }
        } else {
            $mgs = 'ID thương hiệu  không hợp lệ ';
        }
        return view('Admin.Brand.edit',compact('brandDetail'));
     }
     

     public function updateBrand(CatergoryRequest $request) {
         $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
    
        $brand = Brand::findOrFail($id);
    
        $data = $request->validated();
    
        // Cập nhật bản ghi
        if($brand->update($data)){
            return redirect()->back()->with('success',__('Cập nhật thành công'));
        }else{
            return redirect()->back()->with('error',__('Cập nhật thất bại'));
        }
    }
    

     public function delete($id = 0){
        $title = 'Xóa thương hiệu';
        $msg = '';
        if(!empty($id)){
            $brand = Brand::find($id); // Sử dụng Eloquent để tìm cầu thủ cần xóa
            if($brand){
               $deleteStatus = $brand->delete(); // Xóa cầu thủ
               if($deleteStatus){
                $msg = 'Xoá thương hiệuthành công';
               }else{
                $msg = 'Không thể xoá ';
               }
            }else{
               $msg = 'ID thương hiệu không tồn tại';
            }
        } else {
            $msg = 'ID thương hiệu không hợp lệ ';
        }
    }
}
