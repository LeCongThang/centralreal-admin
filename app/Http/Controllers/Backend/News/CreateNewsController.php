<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:58 PM
 */

namespace App\Http\Controllers\Backend\News;


use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Image;
use File;

class CreateNewsController extends Controller
{
    public function Create(){
        try{
            return view('backend.news.create',[
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Storage(Request $request){
        try{
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            $news=new News();
            $news->title_vi=$request->title_vi;
            $news->title_en=$request->title_en;
            $news->is_featured=$request->is_featured ? $request->is_featured : 0;
            $news->description_vi=$request->description_vi;
            $news->description_en=$request->description_en;
            $news->des_short_vi=$request->des_short_vi;
            $news->des_short_en=$request->des_short_en;
            $news->post_type=$request->post_type;
            $news->slug= str_slug($request->title_vi);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'news-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/news/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);

                $news->image = $filename;
            }
            //thumbnail
            if ($request->hasFile('image_thumbnail')) {
                $image1 = $request->file('image_thumbnail');
                $filename_thumbnail = 'news-thumbnail-' .time().'.'. $image1->getClientOriginalExtension();
                $destinationPath1 = public_path('images/news/'.$filename_thumbnail);
                Image::make($image1->getRealPath())->save($destinationPath1);
                $news->image_thumbnail = $filename_thumbnail;
            }
            if($news->save()){
                return redirect('news')->with('success','Thêm tin tức thành công!');
            }else{
                if(File::exists(public_path('images/news/'.$news->image))) {
                    File::delete(public_path('images/news/'.$news->image));
                }
                if(File::exists(public_path('images/news/'.$news->image_thumbnail))) {
                    File::delete(public_path('images/news/'.$news->image_thumbnail));
                }
                return redirect()->back()->with('error','Thêm tin tức thất bại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}