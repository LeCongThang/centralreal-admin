<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class UpdateGalleryController extends Controller
{
    //
    public function Edit($gallery_id)
    {
        try{
            $gallery=Gallery::find($gallery_id);
            if($gallery){
                $image=GalleryImage::where('gallery_id',$gallery_id)
                    ->get();
                return view('backend.gallery.detail',[
                    'gallery'=>$gallery,
                    'image'=>$image
                ]);
            }else{
                return redirect()->back()->with(['error'=>'Không tồn tại!!']);
            }
        }catch (\Exception $e){
            return redirect('error');
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function Update($id,Request $request)
    {
        $arr_image_insert=array();
        try{
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh')->withInput();
            if ($request->hasFile('image')){
                if (count($request->file('image'))>5)
                    return redirect()->back()->with('error','Số lượng hình tối đa là 5')->withInput();
            }
            $gallery=Gallery::find($id);
            if($gallery){
                $arr_image=array();
                $gallery->title_vi=$request->title_vi;
                $gallery->title_en=$request->title_en;
                $gallery->is_active=$request->is_active;
                $gallery->slug=str_slug($request->title_vi);

                $result=DB::transaction(function() use ($gallery, $request,$arr_image,$arr_image_insert){
                    if (!empty($request->get('arrImage'))){
                        $arr=explode(",",substr($request->arrImage, 0, -1));
                        foreach ($arr as $img){
                            $image1=GalleryImage::find($img);
                            if($image1){
                                array_push($arr_image,$image1->image);
                                $image1->delete();
                            }
                        }
                    }
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
                            array_push($arr_image_insert,$file_name);
                            $i++;
                        }
                    }
                    if(count($arr_image)!=0){
                        foreach ($arr_image as $item){
                            if(File::exists(public_path('images/gallery/'.$item))) {
                                File::delete(public_path('images/gallery/'.$item));
                            }
                        }

                    }
                    return redirect('gallery')->with('success','Cập nhật thành công!');
                });
                return $result;
            }else{
                if(count($arr_image_insert)!=0){
                    foreach ($arr_image_insert as $item){
                        if(File::exists(public_path('images/gallery/'.$item))) {
                            File::delete(public_path('images/gallery/'.$item));
                        }
                    }
                }
                return redirect('error');
            }

        }catch (\Exception $e){
            return redirect('error');
        }

    }
}
