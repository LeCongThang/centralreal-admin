<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:46 PM
 */
namespace App\Http\Controllers\Backend\News;
use App\Http\Controllers\Controller;
use App\Models\News;
use File;

class NewsController extends Controller
{
    public function getAll(){
        try{
            $news=News::orderByDesc('updated_at')
                ->get();
            return view('backend.news.index',[
                'news'=>$news
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deleteNews($id){
        try{
            $news=News::find($id);
            return view('backend.news.delete',[
                'news'=>$news
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyNews($id){
        try{
            $news=News::find($id);
            $image=$news->image;
            if($news){
                if($news->delete()){
                    if(File::exists(public_path('images/news/'.$image))) {
                        File::delete(public_path('images/news/'.$image));
                    }
                    return redirect()->back()->with('success','Xóa tin tức thành công!');
                }else{
                    return redirect()->back()->with('error','Xóa tin tức thất bại!');
                }
            }else{
                return redirect()->back()->with('error','Tin tức không tồn tại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}