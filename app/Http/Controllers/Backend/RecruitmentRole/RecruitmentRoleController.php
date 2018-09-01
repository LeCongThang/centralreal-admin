<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:00 PM
 */
namespace App\Http\Controllers\Backend\RecruitmentRole;
use App\Http\Controllers\Controller;
use App\Models\RecruitmentRole;
use Image;
use File;

class RecruitmentRoleController extends Controller
{
    public function getAll(){
        try{
            $role=RecruitmentRole::where('is_delete',0)->orderByDesc('updated_at')
                ->get();
            return view('backend.recruitment_role.index',[
                'role'=>$role
            ]);
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
    public function deleteRecruitmentRole($id){
        try{
            $role=RecruitmentRole::find($id);
            return view('backend.recruitment_role.delete',[
                'role'=>$role
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyRecruitmentRole($id){
        try{
            $role=RecruitmentRole::find($id);
            if($role){
                $role->is_delete=0;
                if($role->save()){
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