<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class PartnerController extends Controller
{
    //
    public function getAll(){
        try{
            $partner=Partner::orderByDesc('updated_at')
                ->get();
            return view('backend.partner.index',[
                'partner'=>$partner
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deletePartner($id){
        try{
            $partner=Partner::find($id);
            return view('backend.partner.delete',[
                'partner'=>$partner
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyPartner($id){
        try{
            $partner=Partner::find($id);
            $image=$partner->image;
            if($partner){
                if($partner->delete()){
                    if(File::exists(public_path('images/partner/'.$image))) {
                        File::delete(public_path('images/partner/'.$image));
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
