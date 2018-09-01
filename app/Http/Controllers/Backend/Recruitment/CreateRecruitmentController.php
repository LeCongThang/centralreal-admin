<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:02 PM
 */

namespace App\Http\Controllers\Backend\Recruitment;


use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use App\Models\RecruitmentRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;

class CreateRecruitmentController extends Controller
{
    public function Create(){
        try{
            $recruitment_role=RecruitmentRole::where('is_delete',0)->get();
            return view('backend.recruitment.create',[
                'role'=>$recruitment_role
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
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            if (empty($request->get('date')))
                return redirect()->back()->with('error','Vui lòng không để trống ngày hết hạn nộp hồ sơ')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            $recruitment=new Recruitment();
            $recruitment->title_vi=$request->title_vi;
            $recruitment->title_en=$request->title_en;
            $recruitment->description_vi=$request->description_vi;
            $recruitment->description_en=$request->description_en;
            $recruitment->recruitment_role_id=$request->recruitment_role_id;
            $recruitment->date = $request->date ? Carbon::createFromFormat('m/d/Y',$request->date)->format('Y-m-d'):'';
            $recruitment->is_active=$request->is_active;
            $recruitment->slug= str_slug($request->title_vi);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'recruitment-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/recruitment/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $recruitment->image = $filename;
            }
            if($recruitment->save()){
                return redirect('recruitment')->with('success','Thêm thành công!');
            }else{
                if(File::exists(public_path('images/recruitment/'.$recruitment->image))) {
                    File::delete(public_path('images/recruitment/'.$recruitment->image));
                }
                return redirect()->back()->with('error','Thêm thất bại!');
            }
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
}