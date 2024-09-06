<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Country;
use App\Http\Requests\UpdateCountryRequest;


class CountryController extends Controller
{
    private $country;

    public function __construct()
    {
        $this->country = new Country(); 
    }

    public function viewAdd(){
        return view('Admin.Table.add');
    }

    public function index(){
        $countries = Country::all(); // Lấy danh sách tất cả các quốc gia từ database
        return view('Admin.Table.country',compact('countries'));
    }

    public function add(){
        $countryList = Country::all();
        return view('Admin.Table.add',compact('countryList'));
    }

    public function insert(Request $request){
        $dataInsert = $request->only('name');
        Country::create($dataInsert); 
        return redirect()->route('Table.country');

     }

     public function getEdit(Request $request,$id = 0){
        if(!empty($id)){
            $countryDetail = Country::find($id);
            if($countryDetail){
                $request->session()->put('id',$id);
            }else{
                $mgs = 'ID người dùng không tồn tại ';
            }
        }else{
            $mgs = 'ID người dùng không hợp lệ ';
        }
        return view('Admin.Table.edit',compact('countryDetail'));
     }
     

     public function updateCountry(UpdateCountryRequest $request) {
         $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
    
        $country = Country::findOrFail($id);
    
        $data = $request->validated();
    
        // Cập nhật bản ghi
        if($country->update($data)){
            return redirect()->back()->with('success',__('Cập nhật thành công'));
        }else{
            return redirect()->back()->with('error',__('Cập nhật thất bại'));
        }
    }
    

     public function delete($id = 0){
        $title = 'Xóa Người Dùng';
        $msg = '';
        if(!empty($id)){
            $country = Country::find($id); // Sử dụng Eloquent để tìm cầu thủ cần xóa
            if($country){
               $deleteStatus = $country->delete(); // Xóa cầu thủ
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
