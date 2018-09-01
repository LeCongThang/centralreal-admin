<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:02 PM
 */

namespace App\Http\Controllers\Backend\RecruitmentRole;
use App\Http\Controllers\Controller;
use App\Models\RecruitmentRole;
use Illuminate\Http\Request;
use Image;
use File;

class UpdateRecruitmentRoleController extends Controller
{
    public function Edit($id){
        try{
            $role=RecruitmentRole::find($id);
            if($role){
                return view('backend.recruitment_role.detail',[
                    'role'=>$role,
                ]);
            }else{
                return redirect('error');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Update($id,Request $request){
        try{
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh')->withInput();
            $role=RecruitmentRole::find($id);
            if($role){
                $role->title_vi=$request->title_vi;
                $role->title_en=$request->title_en;
                if($role->save()){
                    return redirect()->back()->with('success','Cập nhật thành công!');
                }else{
                    return redirect()->back()->with('error','Cập nhật không thành công!');
                }
            }else{

                return redirect('error');
            }

        }catch (\Exception $e){
            return redirect('error');
        }
    }
}