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
        $partner_bank = Partner::where('is_bank', 1)->orderByDesc('updated_at')->get();

        return response()->json([
            'data' => [
                'partner_investor' => $partner_investor,
                'partner_connect' => $partner_connect,
                'partner_bank' => $partner_bank
            ],
            'message' => 'Success'
        ])->setStatusCode('200', 'Success');
    }

    public function getPartnerById($id)
    {
        $partner_related = [];
        $partner = Partner::find($id);
        if ($partner->is_investor == 1) {
            $partner_related = Partner::where('is_investor', 1)->whereNotIn('id', [$partner->id])->limit(3)->get();
        }
        elseif ($partner->is_connect == 1) {
            $partner_related = Partner::where('is_connect', 1)->whereNotIn('id', [$partner->id])->limit(3)->get();
        }
        elseif ($partner->is_bank == 1) {
            $partner_related = Partner::where('is_bank', 1)->whereNotIn('id', [$partner->id])->limit(3)->get();
        }
        if ($partner) {
            return response()->json([
                'data' => [
                    'partner' => $partner,
                    'partner_related' => $partner_related
                ],
                'message' => 'Success'
            ])->setStatusCode('200', 'Success');
        }
        return response()->json([
            'data' => [],
            'message' => 'Fail'
        ])->setStatusCode('400', 'NotFound');
    }

}