<?php

namespace App\Http\Controllers\Backend\Culture;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class CultureController extends Controller
{
    public function getAll()
    {
        try{
            $cultures=Culture::orderBy('sort_order')
                ->get();
            return view('backend.culture.index',[
                'cultures'=>$cultures
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }

    public function deleteCulture($culture_id){
        try{
            $culture=Culture::find($culture_id);
            return view('backend.culture.delete',[
                'culture'=>$culture
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyCulture($culture_id){
        try {
            $culture = Culture::find($culture_id);
            $image = $culture->image;
            if ($culture) {

                $culture->delete();
                if (File::exists(public_path('images/culture/' . $image))) {
                    File::delete(public_path('images/culture/' . $image));
                }
                return redirect()->back()->with('success', 'Xóa thành công!');

            } else {
                return redirect()->back()->with('error', 'Không tồn tại!');
            }
        }
        catch (\Exception $e){
            return redirect()->back()->with('error','Xóa thất bại!');
        }
    }
}
