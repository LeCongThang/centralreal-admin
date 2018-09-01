<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:20 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class AboutController extends Controller
{
    /**
     * Get about us
     *
     * @return $this
     */
    public function getAbout(){
        try{
            $about_us = AboutUs::first();
            return response()->json([
                'data' => $about_us,
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }catch (\Exception $e){
            return response()->json([
                'data' => [],
                'message' => 'Data null'
            ])->setStatusCode('400', 'Bad request');
        }
    }
}