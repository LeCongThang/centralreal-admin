<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:02 PM
 */

namespace App\Http\Controllers\Backend\RecruitmentCentralReal;


use App\Http\Controllers\Controller;
use App\Models\RecruitmentCentralReal;
use Illuminate\Http\Request;
use Image;
use File;

class CreateRecruitmentCentralRealController extends Controller
{
    public function Create(){
        try{
            return view('backend.recruitment_centralreal.create',[
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
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            $recruitment=new RecruitmentCentralReal();
            $recruitment->title_vi=$request->title_vi;
            $recruitment->sort_order=$request->sort_order;
            $recruitment->title_en=$request->title_en;
            $recruitment->description_vi=$request->description_vi;
            $recruitment->description_en=$request->description_en;
            $recruitment->slug= str_slug($request->title_vi);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'recruitment-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/recruitment/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $recruitment->image = $filename;
            }
            if($recruitment->save()){
                return redirect('recruitment-central-real')->with('success','Thêm thành công!');
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