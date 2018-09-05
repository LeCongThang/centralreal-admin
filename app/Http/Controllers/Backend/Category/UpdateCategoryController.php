<?php

namespace App\Http\Controllers\Backend\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class UpdateCategoryController extends Controller
{
    //
    public function Edit($id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                return view('backend.category.detail', [
                    'category' => $category,
                ]);
            } else {
                return redirect('error');
            }
        } catch (\Exception $e) {
            return redirect('error');
        }
    }

    public function Update($category_id, Request $request)
    {
        try {
            if (empty($request->get('title_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên tiếng việt')->withInput();
            if (empty($request->get('title_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên tiếng anh')->withInput();
            $category = Category::find($category_id);
            if ($category) {
                $old_image = $category->image;
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
                    if (File::exists(public_path('images/category/' . $old_image))) {
                        File::delete(public_path('images/category/' . $old_image));
                    }
                }
                if ($category->save()) {
                    return redirect()->back()->with('success', 'Cập nhật thành công!');
                } else {
                    return redirect()->back()->with('error', 'Cập nhật không thành công!');
                }
            } else {
                return redirect('error');
            }

        } catch (\Exception $e) {
            return redirect('error');
        }
    }
}
