<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class UpdateSliderController extends Controller
{
    //
    public function Edit($id){
        try{
            $slider=Slider::find($id);
            if($slider){
                return view('backend.slider.detail',[
                    'slider'=>$slider,
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
            if (empty($request->get('link')))
                return redirect()->back()->with('error','Vui lòng không để trống link')->withInput();
            if (empty($request->get('sort_order')))
                return redirect()->back()->with('error','Vui lòng không để trống thứ tự hiển thị')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            $slider=Slider::find($id);
            if($slider){
                $image_old=$slider->image;
                $flag=0;
                if ($request->hasFile('image')) {
                    $flag=1;
                    $image = $request->file('image');
                    $filename = 'slider-' .time().'.'. $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/slider/'.$filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    $slider->image = $filename;
                }
                $slider->link=$request->link;
                $slider->sort_order=$request->sort_order;
                $slider->description_vi=$request->description_vi;
                $slider->description_en=$request->description_en;
                if($slider->save()){
                    if($flag==1){
                        if(File::exists(public_path('images/slider/'.$image_old))) {
                            File::delete(public_path('images/slider/'.$image_old));
                        }
                    }
                    return redirect()->back()->with('success','Cập nhật tin tức thành công!');
                }else{
                    if($flag==1){
                        if(File::exists(public_path('images/slider/'.$slider->image))) {
                            File::delete(public_path('images/slider/'.$slider->image));
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
