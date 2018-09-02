<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 1:08 AM
 */

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Image;

class CreateProjectController extends Controller
{
    /**
     * CreateProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Create()
    {
        try{
            $category=Category::where('is_delete',0)->get();
            $partner=Partner::get();
            return view('backend.project.create',[
                'category'=>$category,
                'partner'=>$partner,
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
           if (empty($request->get('location_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống vị trí dự án tiếng việt')->withInput();
            if (empty($request->get('location_en')))
                return redirect()->back()->with('error','Vui lòng không để trống trí dự án tiếng anh')->withInput();
            if (empty($request->hasFile('avatar')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh đại diện')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            if (count($request->file('image'))>5)
                return redirect()->back()->with('error','Số lượng hình tối đa là 5')->withInput();
            $project=new Project();
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


//            $project->des_about_vi=$request->des_about_vi;
//            $project->des_about_en=$request->des_about_en;
//
//            $project->des_location_vi=$request->des_location_vi;
//            $project->des_location_en=$request->des_location_en;
//
//            $project->des_utility_vi=$request->des_utility_vi;
//            $project->des_utility_en=$request->des_utility_en;
//
//            $project->des_flat_vi=$request->des_flat_vi;
//            $project->des_flat_en=$request->des_flat_en;

            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $filename = 'project-' .time().'.jpg';
                $destinationPath = public_path('images/project/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $project->image_thumbnail = $filename;
                $project->image = $filename;
            }

//            if ($request->hasFile('avatar_about')) {
//                $image = $request->file('avatar_about');
//                $filename = 'project-about-' .time().'.'. $image->getClientOriginalExtension();
//                $destinationPath = public_path('images/project/'.$filename);
//                Image::make($image->getRealPath())->save($destinationPath);
//                $project->image_about = $filename;
//            }
//            if ($request->hasFile('avatar_location')) {
//                $image = $request->file('avatar_location');
//                $filename = 'project-location-' .time().'.'. $image->getClientOriginalExtension();
//                $destinationPath = public_path('images/project/'.$filename);
//                Image::make($image->getRealPath())->save($destinationPath);
//                $project->image_location = $filename;
//            }
//            if ($request->hasFile('avatar_utility')) {
//                $image = $request->file('avatar_utility');
//                $filename = 'project-utility' .time().'.'. $image->getClientOriginalExtension();
//                $destinationPath = public_path('images/project/'.$filename);
//                Image::make($image->getRealPath())->save($destinationPath);
//                $project->image_utility = $filename;
//            }
//            if ($request->hasFile('avatar_flat')) {
//                $image = $request->file('avatar_flat');
//                $filename = 'project-flat-' .time().'.'. $image->getClientOriginalExtension();
//                $destinationPath = public_path('images/project/'.$filename);
//                Image::make($image->getRealPath())->save($destinationPath);
//                $project->image_flat = $filename;
//            }
            $result=DB::transaction(function() use ($project, $request,$arr_image){
                $project->save();
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $i=0;
                    foreach ($image as $file) {
                        $project_image=new ProjectImage();
                        $project_image->project_id=$project->id;
                        $file_name = 'project-' .time().$i. '.jpg';
                        $destinationPath = public_path('images/project/'.$file_name);
                        Image::make($file->getRealPath())->resize(900, 600)->save($destinationPath);
                        $project_image->image = $file_name;
                        $project_image->save();
                        array_push($arr_image,$file_name);
                        $i++;
                    }
                }
                return redirect('project')->with('success','Thêm thành công!');
            });
            return $result;
        }catch (\Exception $e){
            if(count($arr_image)!=0){
                foreach ($arr_image as $item){
                    if(File::exists(public_path('images/project/'.$item))) {
                        File::delete(public_path('images/project/'.$item));
                    }
                }
            }
            return redirect('error');
        }

    }
}

