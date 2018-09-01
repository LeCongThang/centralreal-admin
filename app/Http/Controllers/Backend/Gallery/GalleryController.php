<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class GalleryController extends Controller
{
    //
    public function getAll()
    {
        try{
            $gallerys=Gallery::orderByDesc('updated_at')
                ->get();
            return view('backend.gallery.index',[
                'gallery'=>$gallerys
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }

    public function deleteGallery($gallery_id){
        try{
            $gallery=Gallery::find($gallery_id);
            return view('backend.gallery.delete',[
                'gallery'=>$gallery
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyGallery($gallery_id){
        try{
            $gallery=Gallery::find($gallery_id);
            $image=$gallery->image;
            if($gallery){
                $result=DB::transaction(function() use ($gallery,$gallery_id, $image){
                    $img=GalleryImage::where('gallery_id',$gallery_id)->get();
                    if(count($img)){
                        foreach ($img as $im){
                            if(File::exists(public_path('images/gallery/'.$im->image))) {
                                File::delete(public_path('images/gallery/'.$im->image));
                            }
                            $im->delete();
                        }
                    }
                    $gallery->delete();
                    if(File::exists(public_path('images/gallery/'.$image))) {
                        File::delete(public_path('images/gallery/'.$image));
                    }
                    return redirect()->back()->with('success','Xóa thành công!');
                });
                return $result;
            }else{
                return redirect()->back()->with('error','Không tồn tại!');
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error','Xóa thất bại!');
        }
    }
}
