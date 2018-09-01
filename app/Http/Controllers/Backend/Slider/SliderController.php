<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class SliderController extends Controller
{
    //
    public function getAll(){
        try{
            $slider=Slider::orderByDesc('updated_at')
                ->get();
            return view('backend.slider.index',[
                'slider'=>$slider
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deleteSlider($id){
        try{
            $slider=Slider::find($id);
            return view('backend.slider.delete',[
                'slider'=>$slider
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroySlider($id){
        try{
            $slider=Slider::find($id);
            $image=$slider->image;
            if($slider){
                if($slider->delete()){
                    if(File::exists(public_path('images/slider/'.$image))) {
                        File::delete(public_path('images/slider/'.$image));
                    }
                    return redirect()->back()->with('success','Xóa thành công!');
                }else{
                    return redirect()->back()->with('error','Xóa thất bại!');
                }
            }else{
                return redirect('error');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}
