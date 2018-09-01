<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use File;
use Image;

class CreateGalleryController extends Controller
{
    //
    public function Create()
    {
        try{
            return view('backend.gallery.create',[
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function Storage(Request $request)
    {
        $arr_image=array();
        try{
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh')->withInput();

            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            if (count($request->file('image'))>5)
                return redirect()->back()->with('error','Số lượng hình tối đa là 5')->withInput();
            $gallery=new Gallery();
            $gallery->title_vi=$request->title_vi;
            $gallery->title_en=$request->title_en;
            $gallery->is_active=$request->is_active;
            $gallery->slug=str_slug($request->title_vi);
            $result=DB::transaction(function() use ($gallery, $request,$arr_image){
                $gallery->save();
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $i=0;
                    foreach ($image as $file) {
                        $gallery_image=new GalleryImage();
                        $gallery_image->gallery_id=$gallery->id;
                        $file_name = 'gallery-' .time().$i. '.'.$file->getClientOriginalExtension();
                        $destinationPath = public_path('images/gallery/'.$file_name);
                        Image::make($file->getRealPath())->save($destinationPath);
                        $gallery_image->image = $file_name;
                        $gallery_image->save();
                        array_push($arr_image,$file_name);
                        $i++;
                    }
                }
                return redirect('gallery')->with('success','Thêm thành công!');
            });
            return $result;
        }catch (\Exception $e){
            dd($e);
            if(count($arr_image)!=0){
                foreach ($arr_image as $item){
                    if(File::exists(public_path('images/gallery/'.$item))) {
                        File::delete(public_path('images/gallery/'.$item));
                    }
                }

            }
            return redirect('error');
        }

    }
}
