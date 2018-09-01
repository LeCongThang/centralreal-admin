<?php

namespace App\Http\Controllers\Backend\ClientFeedback;

use App\Models\ClientFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class UpdateClientFeedbackController extends Controller
{
    //
    public function Edit($id){
        try{
            $feedback=ClientFeedback::find($id);
            if($feedback){
                return view('backend.feedback.detail',[
                    'feedback'=>$feedback,
                ]);
            }else{
                return redirect('error');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Update($feedback_id,Request $request){
        try{
            if (empty($request->get('client_name')))
                return redirect()->back()->with('error','Vui lòng không để trống tên người bình luận')->withInput();
            if (empty($request->get('star')))
                return redirect()->back()->with('error','Vui lòng không để trống số sao')->withInput();
            if (empty($request->get('content_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('content_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            $feedback=ClientFeedback::find($feedback_id);
            if($feedback){
                $image_old=$feedback->image;
                $flag=0;
                if ($request->hasFile('image')) {
                    $flag=1;
                    $image = $request->file('image');
                    $filename = 'feedback-' .time().'.'. $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/feedback/'.$filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    $feedback->image = $filename;
                }
                $feedback->client_name=$request->client_name;
                $feedback->star=$request->star;
                $feedback->content_vi=$request->content_vi;
                $feedback->content_en=$request->content_en;
                $feedback->is_active=$request->is_active;

                if($feedback->save()){
                    if($flag==1){

                        if(File::exists(public_path('images/feedback/'.$image_old))) {
                            File::delete(public_path('images/feedback/'.$image_old));
                        }
                    }
                    return redirect()->back()->with('success','Cập nhật thành công!');
                }else{
                    if($flag==1){
                        if(File::exists(public_path('images/feedback/'.$feedback->image))) {
                            File::delete(public_path('images/feedback/'.$feedback->image));
                        }
                    }
                    return redirect()->back()->with('error','Cập nhật không thành công!');
                }
            }else{

                return redirect('error');
            }

        }catch (\Exception $e){
            return redirect('error');
        }
    }
}
