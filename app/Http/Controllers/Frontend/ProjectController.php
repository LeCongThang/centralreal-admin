<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:00 PM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectRegister;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Get all project
     *
     * @return $this
     */
    public function getAllProject()
    {
        $category=Category::where('is_delete',0)->select('id','title_vi','title_en')->get();
        $partner=Partner::select('id','name')->where('is_investor',1)->get();
        $project_list = Project::with(['rela_category:id,title_vi,title_en','rela_partner:id,name','project_images'])->orderByDesc('updated_at')
            ->select('id',
                'category_id',
                'partner_id',
                'title_vi',

                'title_en',
                'location_vi',
                'location_en',
                'image',
                'slug'
            )
            ->paginate(6);

        if ($project_list) {
            return response()->json([
                'data' => [
                    'categories'=>$category,
                    'partners'=>$partner,
                    'projects'=>$project_list,
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data null'
        ])->setStatusCode('400', 'Bad request');
    }
    public function getFilter($category_id, $partner_id)
    {
        $project_list = Project::with(['rela_category:id,title_vi,title_en','rela_partner:id,name','project_images']);
        if($category_id!=0){
            $project_list=$project_list->where('category_id',$category_id);
        }
        if($partner_id!=0){
            $project_list=$project_list->where('partner_id',$partner_id);
        }
        $project_list=$project_list->orderByDesc('updated_at')
            ->select('id',
                'category_id',
                'partner_id',
                'title_vi',
                'title_en',
                'location_vi',
                'location_en',
                'image',
                'slug'
            )
            ->paginate(9);
        if ($project_list) {
            return response()->json([
                'data' => [
                    'projects'=>$project_list,
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data null'
        ])->setStatusCode('400', 'Bad request');
    }
    /**
     * Get project by id
     *
     * @param $project_id
     * @return $this
     */
    public function getProjectById($project_id){
        $project = Project::with('project_images')->find($project_id);
        if($project){
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
                    'project'=>$project,
                    'projects_rela'=>$projects_rela
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data Not found'
        ])->setStatusCode('404', 'Not found');
    }
    public function registerProject(Request $request){
        try{
            $data = $request->all();
            $register_project = new ProjectRegister();
            $register_project->project_id=$data['project_id'];
            $register_project->name=$data['name'];
            $register_project->phone=$data['phone'];
            $register_project->email=$data['email'];
            if($register_project->save()){
                return response()->json([
                    'data' => $register_project,
                    'message' => 'Success'
                ])->setStatusCode('200', 'Success');
            }else{
                return response()->json([
                    'data' => [],
                    'message' => 'Data Not found'
                ])->setStatusCode('404', 'Not found');
            }
        }catch (\Exception $e){
            return response()->json([
                'data' => [],
                'message' => 'Data Not found'
            ])->setStatusCode('404', 'Not found');
        }
    }
    public function getAllCategory(){
        $cat = Category::orderByDesc('sort_order')->get();
        return response()->json([
            'data'=>$cat,
            'message' => 'Success'
        ])->setStatusCode(200, "Success");
    }
}