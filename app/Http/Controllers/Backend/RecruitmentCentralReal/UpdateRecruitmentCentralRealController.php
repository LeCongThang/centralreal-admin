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

class UpdateRecruitmentCentralRealController extends Controller
{
    public function Edit($id){
        try{
            $recruitment=RecruitmentCentralReal::find($id);
            if($recruitment){
                return view('backend.recruitment_centralreal.detail',[
                    'recruitment'=>$recruitment,
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
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            $recruitment=RecruitmentCentralReal::find($id);
            if($recruitment){
                $image_old=$recruitment->image;
                $flag=0;
                if ($request->hasFile('image')) {
                    $flag=1;
                    $image = $request->file('image');
                    $filename = 'recruitment-' .time().'.'. $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/recruitment/'.$filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    $recruitment->image = $filename;
                }
                $recruitment->title_vi=$request->title_vi;
                $recruitment->sort_order=$request->sort_order;
                $recruitment->title_en=$request->title_en;
                $recruitment->description_vi=$request->description_vi;
                $recruitment->description_en=$request->description_en;
                $recruitment->slug= str_slug($request->title_vi);
                if($recruitment->save()){
                    if($flag==1){

                        if(File::exists(public_path('images/recruitment/'.$image_old))) {
                            File::delete(public_path('images/recruitment/'.$image_old));
                        }
                    }
                    return redirect()->back()->with('success','Cập nhật thành công!');
                }else{
                    if($flag==1){
                        if(File::exists(public_path('images/recruitment/'.$recruitment->image))) {
                            File::delete(public_path('images/recruitment/'.$recruitment->image));
                        }
                    }
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