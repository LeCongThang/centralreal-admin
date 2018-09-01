<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class ProjectController extends Controller
{
    public function getAll()
    {
        try{
            $projects=Project::with(['rela_category:id,title_vi,title_en','rela_partner:id,name'])->orderByDesc('updated_at')
                ->get();
            return view('backend.project.index',[
                'projects'=>$projects
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }

    public function deleteProject($project_id){
        try{
            $project=Project::find($project_id);
            return view('backend.project.delete',[
                'project'=>$project
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyProject($project_id){
        try{
            $project=Project::find($project_id);
            $image=$project->image;
//            $image_about=$project->image_about;
//            $image_location=$project->image_location;
//            $image_utility=$project->image_utility;
//            $image_flat=$project->image_flat;
            if($project){
                $result=DB::transaction(function() use ($project,$project_id,
                    $image
//                    $image_about, $image_location, $image_utility, $image_flat
                ){
                    $img=ProjectImage::where('project_id',$project_id)->get();
                    if(count($img)){
                        foreach ($img as $im){
                            if(File::exists(public_path('images/project/'.$im->image))) {
                                File::delete(public_path('images/project/'.$im->image));
                            }
                            $im->delete();
                        }
                    }
                    $project->delete();
                    if(File::exists(public_path('images/project/'.$image))) {
                        File::delete(public_path('images/project/'.$image));
                    }
//                    if(File::exists(public_path('images/project/'.$image_about))) {
//                        File::delete(public_path('images/project/'.$image_about));
//                    }
//                    if(File::exists(public_path('images/project/'.$image_location))) {
//                        File::delete(public_path('images/project/'.$image_location));
//                    }
//                    if(File::exists(public_path('images/project/'.$image_utility))) {
//                        File::delete(public_path('images/project/'.$image_utility));
//                    }
//                    if(File::exists(public_path('images/project/'.$image_flat))) {
//                        File::delete(public_path('images/project/'.$image_flat));
//                    }
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
