<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 4:02 PM
 */

namespace App\Http\Controllers\Backend\Education;


use App\Http\Controllers\Controller;
use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateEducationController extends Controller
{
    public function Edit($id){
        try{
            $education=Education::find($id);
            if($education){
                return view('backend.education.detail',[
                    'education'=>$education
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
            $education=Education::find($id);
            if($education){
                $education->title_vi=$request->title_vi;
                $education->title_en=$request->title_en;
                $education->description_vi=$request->description_vi;
                $education->description_en=$request->description_en;
                $education->slug= str_slug($request->title_vi);
                if($education->save()){
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