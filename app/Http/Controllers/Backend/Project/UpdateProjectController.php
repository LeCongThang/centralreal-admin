<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class UpdateProjectController extends Controller
{
    /**
     * UpdateProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Edit($project_id)
    {
        try{
            $project=Project::find($project_id);
            if($project){
                $category=Category::where('is_delete',0)->get();
                $partner=Partner::get();
                $image=ProjectImage::where('project_id',$project_id)
                    ->get();
                return view('backend.project.detail',[
                    'project'=>$project,
                    'image'=>$image,
                    'category'=>$category,
                    'partner'=>$partner,
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
           if (empty($request->get('location_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống vị trí dự án tiếng việt')->withInput();
            if (empty($request->get('location_en')))
                return redirect()->back()->with('error','Vui lòng không để trống trí dự án tiếng anh')->withInput();
             if ($request->hasFile('image')){
                if (count($request->file('image'))>5)
                    return redirect()->back()->with('error','Số lượng hình tối đa là 5')->withInput();
            }
            $project=Project::find($id);
            if($project){
                $arr_image=array();
                $project->is_sale=isset($request->is_sale) ? 1:0;
                $project->sort_order=isset($request->sort_order) ? $request->sort_order : 1;
                $project->title_vi=$request->title_vi;
                $project->title_en=$request->title_en;
                $project->category_id=$request->category_id;
                $project->partner_id=$request->partner_id;

                $project->location_vi=$request->location_vi;
                $project->location_en=$request->location_en;
                $project->slug=str_slug($request->title_vi);
                $project->des_short_vi=$request->des_short_vi;
                $project->des_short_en=$request->des_short_en;
                $project->description_vi=$request->description_vi;
                $project->description_en=$request->description_en;

//                $project->des_about_vi=$request->des_about_vi;
//                $project->des_about_en=$request->des_about_en;
//
//                $project->des_location_vi=$request->des_location_vi;
//                $project->des_location_en=$request->des_location_en;
//
//                $project->des_utility_vi=$request->des_utility_vi;
//                $project->des_utility_en=$request->des_utility_en;
//
//                $project->des_flat_vi=$request->des_flat_vi;
//                $project->des_flat_en=$request->des_flat_en;
                if ($request->hasFile('avatar')) {
                    $image = $request->file('avatar');
                    $filename = 'project-' .time().'.'. $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/project/'.$filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    $project->image_thumbnail = $filename;
                    $project->image = $filename;
                }
//                if ($request->hasFile('avatar_about')) {
//                    $image = $request->file('avatar_about');
//                    $filename = 'project-about-' .time().'.'. $image->getClientOriginalExtension();
//                    $destinationPath = public_path('images/project/'.$filename);
//                    Image::make($image->getRealPath())->save($destinationPath);
//                    $project->image_about = $filename;
//                }
//                if ($request->hasFile('avatar_location')) {
//                    $image = $request->file('avatar_location');
//                    $filename = 'project-location-' .time().'.'. $image->getClientOriginalExtension();
//                    $destinationPath = public_path('images/project/'.$filename);
//                    Image::make($image->getRealPath())->save($destinationPath);
//                    $project->image_location = $filename;
//                }
//                if ($request->hasFile('avatar_utility')) {
//                    $image = $request->file('avatar_utility');
//                    $filename = 'project-utility' .time().'.'. $image->getClientOriginalExtension();
//                    $destinationPath = public_path('images/project/'.$filename);
//                    Image::make($image->getRealPath())->save($destinationPath);
//                    $project->image_utility = $filename;
//                }
//                if ($request->hasFile('avatar_flat')) {
//                    $image = $request->file('avatar_flat');
//                    $filename = 'project-flat-' .time().'.'. $image->getClientOriginalExtension();
//                    $destinationPath = public_path('images/project/'.$filename);
//                    Image::make($image->getRealPath())->save($destinationPath);
//                    $project->image_flat = $filename;
//                }
                $result=DB::transaction(function() use ($project, $request,$arr_image,$arr_image_insert){
                    if (!empty($request->get('arrImage'))){
                        $arr=explode(",",substr($request->arrImage, 0, -1));
                        foreach ($arr as $img){
                            $image1=ProjectImage::find($img);
                            if($image1){
                                array_push($arr_image,$image1->image);
                                $image1->delete();
                            }
                        }
                    }
                    $project->save();
                    if ($request->hasFile('image')) {
                        $image = $request->file('image');
                        $i=0;
                        foreach ($image as $file) {
                            $gallery_image=new ProjectImage();
                            $gallery_image->project_id=$project->id;
                            $file_name = 'project-' .time().$i. '.'.$file->getClientOriginalExtension();
                            $destinationPath = public_path('images/project/'.$file_name);
                            Image::make($file->getRealPath())->resize(900, 600)->save($destinationPath);
                            $gallery_image->image = $file_name;
                            $gallery_image->save();
                            array_push($arr_image_insert,$file_name);
                            $i++;
                        }
                    }
                    if(count($arr_image)!=0){
                        foreach ($arr_image as $item){
                            if(File::exists(public_path('images/project/'.$item))) {
                                File::delete(public_path('images/project/'.$item));
                            }
                        }

                    }
                    return redirect('project')->with('success','Cập nhật thành công!');
                });
                return $result;
            }else{
                if(count($arr_image_insert)!=0){
                    foreach ($arr_image_insert as $item){
                        if(File::exists(public_path('images/project/'.$item))) {
                            File::delete(public_path('images/project/'.$item));
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
