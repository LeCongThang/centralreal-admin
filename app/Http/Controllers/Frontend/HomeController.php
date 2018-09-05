<?php

namespace App\Http\Controllers\Frontend;

use App\Models\AboutUs;
use App\Models\ClientFeedback;
use App\Models\ConfigPopup;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Slider;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
   public function getHome(){
       try{

           $sliders=Slider::orderBy('sort_order')->get();
           $projects=Project::with(['rela_category:id,title_vi,title_en','rela_partner:id,name'])->where('is_sale', 1)->orderBy('sort_order')->limit(6)
               ->select('id',
                   'title_vi',
                   'title_en',
               'category_id',
               'partner_id',
                   'location_vi',
                   'location_en',
                   'image',
                   'image_thumbnail',
                   'slug',
                   'des_short_vi',
                   'des_short_en'
               )
               ->get();
           $events=News::where('is_featured',1)->where('post_type',0)
               ->orderByDesc('updated_at')
               ->select('id',
                   'title_vi',
                   'title_en',
                   'slug',
                   'image',
                   'image_thumbnail'
               )
               ->get();
//           $galleries=Gallery::with('gallery_images')->where('is_active', 1)->orderByDesc('updated_at')->limit(5)->get();
           $news=News::where('is_featured',1)->where('post_type',1)->orderByDesc('updated_at')->limit(5)
               ->select('id',
                   'title_vi',
                   'title_en',
                   'slug',
                   'image',
                   'image_thumbnail',
                   'des_short_vi',
                   'des_short_en'
               )
               ->get();
           $video=News::where('post_type',2)->orderByDesc('updated_at')->first();
           $feed_backs=ClientFeedback::orderByDesc('updated_at')->limit(6)->get();
           $partners= Partner::orderByDesc('updated_at')->get();
           $about= AboutUs::first();
           return response()->json([
               'data' => [
                   'about'=>$about,
                   'sliders'=>$sliders,
                   'projects'=>$projects,
                   'events'=>$events,
//                   'galleries'=>$galleries,
                   'news'=>$news,
                   'video'=>$video,
                   'feed_backs'=>$feed_backs,
                   'partners'=>$partners
               ],
               'message' => 'Success'
           ])->setStatusCode('200', 'Success');
       }catch (\Exception $e){
           dd($e);
           return response()->json([
               'data' => [],
               'message' => 'Data null'
           ])->setStatusCode('400', 'Bad request');
       }
   }
   public function getConfig(){
       try{
           $config=SystemConfig::first();
           $config_popup=ConfigPopup::first();
           if($config_popup){
               $arr=explode(',',$config_popup->arr_link);
               foreach ($arr as $key=>$item){
                   $arr[$key] = substr($item, 1, strlen($item) - 2);
               }
               $config_popup->arr_link=$arr;
           }
           $directory=[
               'about'=>url('images/about/'),
               'feedback'=>url('images/feedback/'),
               'gallery'=>url('images/gallery/'),
               'news'=>url('images/news/'),
               'partner'=>url('images/partner/'),
               'project'=>url('images/project/'),
               'recruitment'=>url('images/recruitment/'),
               'slider'=>url('images/slider/'),
               'config'=>url('images/config/'),
               'people'=>url('images/people/'),
               'category'=>url('images/category/'),
               'culture'=>url('images/culture/'),
           ];
           return response()->json([
               'data' => [
                   'config'=>$config,
                   'config_popup'=>$config_popup,
                   'directory'=>$directory,
               ],
               'message' => 'Success'
           ])->setStatusCode('200', 'Success');
       }catch (\Exception $e){

       }

   }
}
