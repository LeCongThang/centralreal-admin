<?php

namespace App\Http\Controllers\Backend\ClientFeedback;

use App\Models\ClientFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class ClientFeedbackController extends Controller
{
    //
    public function getAll(){
        try{
            $feedback=ClientFeedback::orderByDesc('updated_at')
                ->get();
            return view('backend.feedback.index',[
                'feedback'=>$feedback
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deleteFeedback($id){
        try{
            $feedback=ClientFeedback::find($id);
            return view('backend.feedback.delete',[
                'feedback'=>$feedback
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyFeedback($id){
        try{
            $feedback=ClientFeedback::find($id);
            $image=$feedback->image;
            if($feedback){
                if($feedback->delete()){
                    if(File::exists(public_path('images/feedback/'.$image))) {
                        File::delete(public_path('images/feedback/'.$image));
                    }
                    return redirect()->back()->with('success','Xóa thành công!');
                }else{
                    return redirect()->back()->with('error','Xóa thất bại!');
                }
            }else{
                return redirect()->back()->with('error','Không tồn tại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}
