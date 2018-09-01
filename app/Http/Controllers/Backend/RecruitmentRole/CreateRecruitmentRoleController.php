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

class CreateRecruitmentRoleController extends Controller
{
    public function Create(){
        try{
            return view('backend.recruitment_role.create',[
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Storage(Request $request){
        try{
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh')->withInput();
            $role=new RecruitmentRole();
            $role->title_vi=$request->title_vi;
            $role->title_en=$request->title_en;
            if($role->save()){
                return redirect('recruitment-role')->with('success','Thêm thành công!');
            }else{
                return redirect()->back()->with('error','Thêm thất bại!');
            }
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
}