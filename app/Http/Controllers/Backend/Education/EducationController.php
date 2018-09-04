<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:00 PM
 */
namespace App\Http\Controllers\Backend\Education;
use App\Http\Controllers\Controller;
use App\Models\Education;
use Image;
use File;

class EducationController extends Controller
{
    public function getAll(){
        try{
            $education=Education::orderByDesc('updated_at')
                ->get();
            return view('backend.education.index',[
                'education'=>$education
            ]);
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
    public function deleteEducation($id){
        try{
            $education=Education::find($id);
            return view('backend.education.delete',[
                'education'=>$education
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyEducation($id){
        try{
            $education=Education::find($id);
            $image=$education->image;
            if($education){
                if($education->delete()){
                    if(File::exists(public_path('images/education/'.$image))) {
                        File::delete(public_path('images/education/'.$image));
                    }
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