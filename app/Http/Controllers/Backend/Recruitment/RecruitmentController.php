<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:00 PM
 */
namespace App\Http\Controllers\Backend\Recruitment;
use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Image;
use File;

class RecruitmentController extends Controller
{
    public function getAll(){
        try{
            $recruitment=Recruitment::with(['rela_role'=>function($q){
                return $q->where('is_delete',0);
            }])->orderByDesc('updated_at')
                ->get();
            return view('backend.recruitment.index',[
                'recruitment'=>$recruitment
            ]);
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
    public function deleteRecruitment($id){
        try{
            $recruitment=Recruitment::find($id);
            return view('backend.recruitment.delete',[
                'recruitment'=>$recruitment
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyRecruitment($id){
        try{
            $recruitment=Recruitment::find($id);
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