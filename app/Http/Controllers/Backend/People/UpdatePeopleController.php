<?php

namespace App\Http\Controllers\Backend\People;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class UpdatePeopleController extends Controller
{
    /**
     * UpdatePeopleController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $people_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Edit($people_id)
    {
        try {
            $people = People::find($people_id);
            if ($people) {
                return view('backend.people.detail', [
                    'people' => $people,
                ]);
            } else {
                return redirect()->back()->with(['error' => 'Không tồn tại!!']);
            }
        } catch (\Exception $e) {
            return redirect('error');
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function Update($id, Request $request)
    {
        $filename='';
        try {
            if (empty($request->get('name_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống mô tả')->withInput();
            $people = People::find($id);
            if ($people) {
                $people->name_vi = $request->name_vi;
                $people->name_en = $request->name_en;
                $people->slug = str_slug($request->position_vi) . '-' . str_slug($request->name_vi);
                $people->description_vi = $request->description_vi;
                $people->description_en = $request->description_en;
                $people->position_vi = $request->position_vi;
                $people->position_en = $request->position_en;
                $people->is_active = isset($request->is_active) ? 1:0;
                if ($request->hasFile('avatar')) {
                    $image = $request->file('avatar');
                    $filename = 'people-' . str_slug($request->name_vi) . '-' . time() . '.jpg';
                    $destinationPath = public_path('images/people/' . $filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    $people->avatar = $filename;
                }
                $people->save();
                return redirect('people')->with('success', 'Thêm thành công!');
            } else {
                if (File::exists(public_path('images/people/' . $filename))) {
                    File::delete(public_path('images/people/' . $filename));
                }
                return redirect('error');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect('error');
        }

    }
}
