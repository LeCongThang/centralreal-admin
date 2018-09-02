<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class UpdatePartnerController extends Controller
{
    //
    public function Edit($id){
        try{
            $partner=Partner::find($id);
            if($partner){
                return view('backend.partner.detail',[
                    'partner'=>$partner,
                ]);
            }else{
                return redirect('error');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Update($partner_id,Request $request){
        try{
            if (empty($request->get('name')))
                return redirect()->back()->with('error','Vui lòng không để trống tên đối tác')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng việt')->withInput();
            if (empty($request->get('description_en')))
                return redirect()->back()->with('error','Vui lòng không để trống nội dung tiếng anh')->withInput();
            $partner=Partner::find($partner_id);
            if($partner){
                $image_old=$partner->image;
                $flag=0;
                if ($request->hasFile('image')) {
                    $flag=1;
                    $image = $request->file('image');
                    $filename = 'partner-' .time().'.'. $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/partner/'.$filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    $partner->image = $filename;
                }
                $partner->name=$request->name;
                $partner->is_investor=$request->is_check==1 ? 1:0;
                $partner->is_connect=$request->is_check==0 ? 1:0;
                $partner->is_bank=$request->is_check==2 ? 1:0;
                $partner->description_vi=$request->description_vi;
                $partner->description_en=$request->description_en;
                $partner->slug= str_slug($request->name);
                if($partner->save()){
                    if($flag==1){

                        if(File::exists(public_path('images/partner/'.$image_old))) {
                            File::delete(public_path('images/partner/'.$image_old));
                        }
                    }
                    return redirect()->back()->with('success','Cập nhật thành công!');
                }else{
                    if($flag==1){
                        if(File::exists(public_path('images/partner/'.$partner->image))) {
                            File::delete(public_path('images/partner/'.$partner->image));
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
