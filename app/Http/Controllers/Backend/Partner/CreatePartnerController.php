<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;

class CreatePartnerController extends Controller
{
    //
    public function Create(){
        try{
            return view('backend.partner.create',[
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Storage(Request $request){
        try{
            if (empty($request->get('name')))
                return redirect()->back()->with('error','Vui lòng không để trống tên đối tác')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            $partner=new Partner();
            $partner->name=$request->name;
            $partner->is_investor=$request->is_check==1 ? 1:0;
            $partner->is_connect=$request->is_check==0 ? 1:0;
            $partner->slug=str_slug($request->name);
            $partner->description_vi=$request->description_vi;
            $partner->description_en=$request->description_en;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'partner-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/partner/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $partner->image = $filename;
            }
            if($partner->save()){
                return redirect('partner')->with('success','Thêm thành công!');
            }else{
                if(File::exists(public_path('images/partner/'.$partner->image))) {
                    File::delete(public_path('images/partner/'.$partner->image));
                }
                return redirect()->back()->with('error','Thêm thất bại!');
            }
        }catch (\Exception $e){

            return redirect('error');
        }
    }
}
