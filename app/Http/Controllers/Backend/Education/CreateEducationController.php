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
use Illuminate\Http\Request;

class CreateEducationController extends Controller
{
    public function Create(){
        try{
            return view('backend.education.create');
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Storage(Request $request){
        try{
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt')->withInput();
            $education=new Education();
            $education->title_vi=$request->title_vi;
            $education->title_en=$request->title_en;
            $education->description_vi=$request->description_vi;
            $education->description_en=$request->description_en;
            $education->slug= str_slug($request->title_vi);
            if($education->save()){
                return redirect('education')->with('success','Thêm thành công!');
            }else{
                return redirect()->back()->with('error','Thêm thất bại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}