<?php

namespace App\Http\Controllers\Backend\Culture;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Http\Request;
use Image;
use File;

class UpdateCultureController extends Controller
{
    /**
     * UpdateCultureController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $culture_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Edit($culture_id)
    {
        try {
            $culture = Culture::find($culture_id);
            if ($culture) {
                return view('backend.culture.detail', [
                    'culture' => $culture,
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
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống mô tả')->withInput();
            $culture = Culture::find($id);
            if ($culture) {
                $old_file = $culture->image;
                $culture->title_vi = $request->title_vi;
                $culture->title_en = $request->title_en;
                $culture->description_vi = $request->description_vi;
                $culture->description_en = $request->description_en;
                $culture->sort_order = $request->sort_order;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = 'culture-' . str_slug($request->title_vi) . '-' . time() . '.jpg';
                    $destinationPath = public_path('images/culture/' . $filename);
                    Image::make($image->getRealPath())->save($destinationPath);
                    if (File::exists(public_path('images/culture/' . $old_file))) {
                        File::delete(public_path('images/culture/' . $old_file));
                    }
                    $culture->image = $filename;
                }
                if($culture->save()){
                    return redirect('culture')->with('success', 'Thêm thành công!');
                }else {
                    if (File::exists(public_path('images/culture/' . $filename))) {
                        File::delete(public_path('images/culture/' . $filename));
                    }
                    return redirect('error');
                }

            }
        } catch (\Exception $e) {
            dd($e);
            return redirect('error');
        }

    }
}
