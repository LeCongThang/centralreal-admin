<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:29 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Get all gallery
     *
     * @return $this
     */
    public function getAllGallery()
    {
        $gallery_list = Gallery::with(['gallery_images'])->where('is_active', 1)
            ->orderByDesc('updated_at')
            ->paginate(6);
        if ($gallery_list) {
            return response()->json([
                'data' => $gallery_list,
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data null'
        ])->setStatusCode('400', 'Bad request');
    }

    /**
     * Get gallery by id
     *
     * @param $gallery_id
     * @return $this
     */
    public function getGalleryById($gallery_id)
    {
        $gallery = Gallery::with(['gallery_images'])->find($gallery_id);
        $gallery_related = Gallery::with(['gallery_images'])->where('id', '!=', $gallery->id)->orderByDesc('updated_at')->limit(3)->get();
        if ($gallery) {
            return response()->json([
                'data' => [
                    'gallery' => $gallery,
                    'gallery_related' => $gallery_related
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data Not found'
        ])->setStatusCode('404', 'Not found');
    }
}