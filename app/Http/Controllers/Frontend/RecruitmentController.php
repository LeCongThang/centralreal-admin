<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:22 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use App\Models\RecruitmentCentralReal;
use App\Models\RecruitmentRole;

class RecruitmentController extends Controller
{
    const ACTIVE = 1;
    const DEACTIVE = 0;
    /**
     * Get all recruitment
     *
     * @return $this
     */
    public function getAllRecruitment()
    {
        $recruitment_central_real = RecruitmentCentralReal::orderBy('sort_order')->get();
        $recruitment_list = Recruitment::where('is_active',self::ACTIVE)->orderByDesc('updated_at')->get();
        $recruitment_category = RecruitmentRole::where('is_delete',0)->orderByDesc('updated_at')->get();
        if ($recruitment_list) {
            return response()->json([
                'data' => [
                    'recruitment_central_real'=>$recruitment_central_real,
                    'recruitment_category'=>$recruitment_category,
                    'recruitment'=>$recruitment_list
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data null'
        ])->setStatusCode('400', 'Bad request');
    }

    /**
     * Get recruitment by id
     *
     * @param $recruitment_id
     * @return $this
     */
    public function getRecruitmentById($recruitment_id)
    {
        $recruitment = Recruitment::find($recruitment_id);
        if ($recruitment) {
            return response()->json([
                'data' => $recruitment,
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Data Not found'
        ])->setStatusCode('404', 'Not found');
    }
}