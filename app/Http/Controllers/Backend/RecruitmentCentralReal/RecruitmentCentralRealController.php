<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:00 PM
 */
namespace App\Http\Controllers\Backend\RecruitmentCentralReal;
use App\Http\Controllers\Controller;
use App\Models\RecruitmentCentralReal;
use Image;
use File;

class RecruitmentCentralRealController extends Controller
{
    public function getAll(){
        try{
            $recruitment=RecruitmentCentralReal::orderByDesc('updated_at')
                ->get();
            return view('backend.recruitment_centralreal.index',[
                'recruitment'=>$recruitment
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deleteRecruitment($id){
        try{
            $recruitment=RecruitmentCentralReal::find($id);
            return view('backend.recruitment_centralreal.delete',[
                'recruitment'=>$recruitment
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyRecruitment($id){
        try{
            $recruitment=RecruitmentCentralReal::find($id);
            $image=$recruitment->image;
            if($recruitment){
                if($recruitment->delete()){
                    if(File::exists(public_path('images/recruitment/'.$image))) {
                        File::delete(public_path('images/recruitment/'.$image));
                    }
                    return redirect()->back()->with('success','Xóa tin tức thành công!');
                }else{
                    return redirect()->back()->with('error','Xóa tin tức thất bại!');
                }
            }else{
                return redirect()->back()->with('error','Tin tức không tồn tại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}