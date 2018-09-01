<?php

namespace App\Http\Controllers\Backend\AboutUs;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class AboutUsController extends Controller
{
    //
    public function getAll()
    {
        $about = AboutUs::first();
        return view('backend.about.index',compact('about'));
    }
    public function updateAboutUs(Request $request){
        try{
            if (empty($request->get('content_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('content_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            if (empty($request->get('embed_link')))
                return redirect()->back()->with('error','Vui lòng không để trống embed_link')->withInput();
            if (empty($request->get('clients')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh dưới tin tức')->withInput();
            if (empty($request->get('transports')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt dưới thư viện')->withInput();
            if (empty($request->get('projects')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng anh dưới thư viện')->withInput();
            if (empty($request->get('awards')))
                return redirect()->back()->with('error','Vui lòng không để trống tiêu đề tiếng việt dưới tin tức nổi bật')->withInput();
            $about = AboutUs::first();
            $about->content_vi=$request->content_vi;
            $about->content_en=$request->content_en;
            $about->video_link=$request->video_link;
            $about->embed_link=$request->embed_link;
            $about->is_show=$request->is_show;
            $about->clients=$request->clients;
            $about->transports=$request->transports;
            $about->projects=$request->projects;
            $about->awards=$request->awards;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'about-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/about/'.$filename);
                Image::make($image->getRealPath())->resize(500,280)->save($destinationPath);
                $about->image = $filename;
            }
            $about->save();
            return redirect()->back()->with(['success'=>'Cập nhật thành công!!']);

        }catch (\Exception $e){
            dd($e);
            return redirect()->back()->with(['error'=>'Cập nhật thất bại!!'])->withInput();
        }
    }
}
