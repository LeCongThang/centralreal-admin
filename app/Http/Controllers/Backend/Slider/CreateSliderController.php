<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;

class CreateSliderController extends Controller
{
    //
    public function Create(){
        try{
            return view('backend.slider.create',[
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Storage(Request $request){
        try{
            if (empty($request->get('link')))
                return redirect()->back()->with('error','Vui lòng không để trống link')->withInput();
            if (empty($request->get('sort_order')))
                return redirect()->back()->with('error','Vui lòng không để trống thứ tự hiển thị')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            $slider=new Slider();
            $slider->link=$request->link;
            $slider->sort_order=$request->sort_order;
            $slider->description_vi=$request->description_vi;
            $slider->description_en=$request->description_en;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'slider-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/slider/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $slider->image = $filename;
            }
            if($slider->save()){
                return redirect('slider')->with('success','Thêm thành công!');
            }else{
                if(File::exists(public_path('images/slider/'.$slider->image))) {
                    File::delete(public_path('images/slider/'.$slider->image));
                }
                return redirect()->back()->with('error','Thêm thất bại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}
