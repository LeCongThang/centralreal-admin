<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:33 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Partner;

class PartnerController extends Controller
{
    /**
     * Get all partner API
     *
     * @return $this
     */
    public function getAllPartner()
    {
        $partner_investor = Partner::where('is_investor', 1)->orderByDesc('updated_at')->get();
        $partner_connect = Partner::where('is_connect', 1)->orderByDesc('updated_at')->get();

        return response()->json([
            'data' => [
                'partner_investor' => $partner_investor,
                'partner_connect' => $partner_connect
            ],
            'message' => 'Success'
        ])->setStatusCode('200', 'Success');
    }
    public function getPartnerById($id)
    {
        $partner = Partner::find($id);
        if($partner){
            return response()->json([
                'data' => $partner,
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Fail'
        ])->setStatusCode('400', 'NotFound');
    }

}