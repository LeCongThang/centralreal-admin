<?php

namespace App\Http\Controllers\Backend\ClientFeedback;

use App\Models\ClientFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;

class CreateClientFeedbackController extends Controller
{
    //
    public function Create(){
        try{
            return view('backend.feedback.create',[
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Storage(Request $request){
        try{
            if (empty($request->get('client_name')))
                return redirect()->back()->with('error','Vui lòng không để trống tên người bình luận')->withInput();
            if (empty($request->get('star')))
                return redirect()->back()->with('error','Vui lòng không để trống số sao')->withInput();
            if (empty($request->get('content_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('content_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error','Vui lòng không để trống hình ảnh')->withInput();
            $feedback=new ClientFeedback();
            $feedback->client_name=$request->client_name;
            $feedback->star=$request->star;
            $feedback->content_vi=$request->content_vi;
            $feedback->content_en=$request->content_en;
            $feedback->is_active=$request->is_active;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'feedback-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/feedback/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $feedback->image = $filename;
            }
            if($feedback->save()){
                return redirect('feedback')->with('success','Thêm thành công!');
            }else{
                if(File::exists(public_path('images/feedback/'.$feedback->image))) {
                    File::delete(public_path('images/feedback/'.$feedback->image));
                }
                return redirect()->back()->with('error','Thêm thất bại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}
