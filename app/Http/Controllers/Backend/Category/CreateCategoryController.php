<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;

class CreateCategoryController extends Controller
{
    //
    public function Create()
    {
        try {
            return view('backend.category.create', [
            ]);
        } catch (\Exception $e) {
            return redirect('error');
        }
    }

    public function Storage(Request $request)
    {
        try {
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên tiếng anh')->withInput();
            $category = new Category();
            $category->title_vi = $request->title_vi;
            $category->title_en = $request->title_en;
            $category->sort_order = $request->sort_order;
            $category->slug = str_slug($request->title_vi);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'category-' . time() . '.jpg';
                $destinationPath = public_path('images/category/' . $filename);
                Image::make($image->getRealPath())->save($destinationPath);
                $category->image = $filename;
            }
            if ($category->save()) {
                return redirect('category')->with('success', 'Thêm thành công!');
            } else {
                return redirect()->back()->with('error', 'Thêm thất bại!');
            }
        } catch (\Exception $e) {

            return redirect('error');
        }
    }
}
