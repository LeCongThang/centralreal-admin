<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:39 PM
 */

namespace App\Http\Controllers\Backend\ConfigPopup;

use App\Http\Controllers\Controller;
use App\Models\ConfigPopup;
use App\Models\SystemConfig;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ConfigPopupController extends Controller
{
    public function getAll()
    {
        $popup = ConfigPopup::first();
        return view('backend.config_popup.index',compact('popup'));
    }
    public function updateConfig(Request $request){
        try{
            if (empty($request->get('delay')))
                return redirect()->back()->with('error','Vui lòng không để trống thời gian delay')->withInput();
            $setting = ConfigPopup::first();
            $setting->delay=$request->delay;
            $setting->is_active=$request->is_active ? 1:0;
            $setting->type=$request->type;
            $setting->video=$request->video;
            $setting->arr_link=$request->arr_link;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'config-' .time().'.'. $image->getClientOriginalExtension();
                $destinationPath = public_path('images/config/'.$filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $setting->image = $filename;
            }
            $setting->save();
            return redirect()->back()->with(['success'=>'Cập nhật thành công!!']);
        }catch (\Exception $e){
        dd($e);
        return redirect()->back()->with(['error'=>'Cập nhật thất bại!!'])->withInput();
        }
    }

}