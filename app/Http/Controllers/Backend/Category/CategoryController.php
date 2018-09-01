<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class CategoryController extends Controller
{
    //
    public function getAll(){
        try{
            $category=Category::orderByDesc('updated_at')
                ->get();
            return view('backend.category.index',[
                'category'=>$category
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deleteCategory($id){
        try{
            $category=Category::find($id);
            return view('backend.category.delete',[
                'category'=>$category
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyCategory($id){
        try{
            $category=Category::find($id);
            if($category){
                if($category->delete()){
                    return redirect()->back()->with('success','Xóa thành công!');
                }else{
                    return redirect()->back()->with('error','Xóa thất bại!');
                }
            }else{
                return redirect()->back()->with('error','Không tồn tại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}
