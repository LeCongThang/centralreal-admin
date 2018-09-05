<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 1:08 AM
 */

namespace App\Http\Controllers\Backend\Culture;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Http\Request;
use File;
use Image;

class CreateCultureController extends Controller
{
    /**
     * CreateCultureController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Create()
    {
        try {
            return view('backend.culture.create');
        } catch (\Exception $e) {
            return redirect('error');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function Storage(Request $request)
    {
        $filename = '';
        try {
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên')->withInput();
            if (empty($request->hasFile('image')))
                return redirect()->back()->with('error', 'Vui lòng không để trống hình ảnh đại diện')->withInput();
            if (empty($request->get('description_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống mô tả')->withInput();
            $culture = new Culture();
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
                $culture->image = $filename;
            }
            $culture->save();
            return redirect('culture')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            dd($e);
            if (File::exists(public_path('images/culture/' . $filename))) {
                File::delete(public_path('images/culture/' . $filename));
            }
            return redirect('error');
        }

    }
}

