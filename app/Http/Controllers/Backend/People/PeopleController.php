<?php

namespace App\Http\Controllers\Backend\People;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class PeopleController extends Controller
{
    public function getAll()
    {
        try{
            $peoples=People::orderByDesc('updated_at')
                ->get();
            return view('backend.people.index',[
                'peoples'=>$peoples
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }

    public function deletePeople($people_id){
        try{
            $people=People::find($people_id);
            return view('backend.people.delete',[
                'people'=>$people
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyPeople($people_id){
        try {
            $people = People::find($people_id);
            $image = $people->avatar;
            if ($people) {

                $people->delete();
                if (File::exists(public_path('images/people/' . $image))) {
                    File::delete(public_path('images/people/' . $image));
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
