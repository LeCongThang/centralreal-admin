<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:18 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Project;

class NewsController extends Controller
{
    const EVENT = 0;
    const NEWS = 1;
    const VIDEO = 2;
    /**
     * Get all news
     *
     * @return $this
     */
    public function getAllNews()
    {
        try{
            $news_list = News::where('post_type',self::NEWS)->orderByDesc('is_featured')
                ->paginate(9);
            $news_video = News::where('post_type',self::VIDEO)->orderByDesc('updated_at')
                ->paginate(5);
            return response()->json([
                'data' =>[
                    'news'=>$news_list,
                    'videos'=>$news_video
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

    /**
     * Get news by id
     *
     * @param $news_id
     * @return $this
     */
    public function getNewsById($news_id)
    {
        $news = News::find($news_id);
        if ($news) {
            $news_featured = News::where('id','!=', $news_id)->where('post_type',$news->post_type)->where('is_featured',1)->orderByDesc('updated_at')
                ->limit(5)->get();
            $projects_rela=Project::with(['rela_category:id,title_vi,title_en','rela_partner:id,name'])
                ->where('is_sale', 1)->orderBy('sort_order')->limit(3)
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
            return response()->json([
                'data' => [
                    'news'=>$news,
                    'news_featured'=>$news_featured,
                    'project_featured'=>$projects_rela,
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data Not found'
        ])->setStatusCode('404', 'Not found');
    }
    public function getEventById($news_id)
    {
        $news = News::find($news_id);
        if ($news) {
            $news_featured = News::where('id','!=', $news_id)->where('post_type',0)->where('is_featured',1)->orderByDesc('updated_at')
                ->limit(5)->get();
            $projects_rela=Project::with(['rela_category:id,title_vi,title_en','rela_partner:id,name'])
                ->where('is_sale', 1)->orderBy('sort_order')->limit(3)
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
            return response()->json([
                'data' => [
                    'event'=>$news,
                    'event_featured'=>$news_featured,
                    'project_featured'=>$projects_rela,
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data Not found'
        ])->setStatusCode('404', 'Not found');
    }
    public function getAllEvent()
    {
        try{
            $event_featured = News::where('post_type',self::EVENT)->where('is_featured',1)->orderByDesc('updated_at')
                ->limit(4)->get();
            $event = News::where('post_type',self::EVENT)->orderByDesc('updated_at')->paginate(4);
            return response()->json([
                'data' => [
                    'event'=>$event,
                    'event_featured'=>$event_featured
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
    public function getAllVideo()
    {
        try{
            $news_video = News::where('post_type',self::VIDEO)->orderByDesc('updated_at')
                ->paginate(5);
            return response()->json([
                'data' =>$news_video,
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
    /**
     * Get news by id
     *
     * @param $news_id
     * @return $this
     */

}