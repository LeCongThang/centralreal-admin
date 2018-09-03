<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:39 PM
 */

namespace App\Http\Controllers\Backend\Config;

use App\Http\Controllers\Controller;
use App\Models\SystemConfig;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getAll()
    {
        $system = SystemConfig::first();
        return view('backend.system.index', compact('system'));
    }

    public function updateConfig(Request $request)
    {
        try {
            if (empty($request->get('google_plus')))
                return redirect()->back()->with('error', 'Vui lòng không để trống link google_plus')->withInput();
            if (empty($request->get('viber')))
                return redirect()->back()->with('error', 'Vui lòng không để trống link viber')->withInput();
            if (empty($request->get('youtube')))
                return redirect()->back()->with('error', 'Vui lòng không để trống link youtube')->withInput();
            if (empty($request->get('facebook')))
                return redirect()->back()->with('error', 'Vui lòng không để trống link facebook')->withInput();
            if (empty($request->get('name_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên công ty tiếng việt')->withInput();
            if (empty($request->get('name_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tên công ty tiếng anh')->withInput();
            if (empty($request->get('email_header')))
                return redirect()->back()->with('error', 'Vui lòng không để trống email trên header')->withInput();
            if (empty($request->get('hotline')))
                return redirect()->back()->with('error', 'Vui lòng không để trống số điện thoại hotline')->withInput();
            if (empty($request->get('address_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống địa chỉ tiếng việt')->withInput();
            if (empty($request->get('address_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống địa chỉ tiếng anh')->withInput();
            if (empty($request->get('email')))
                return redirect()->back()->with('error', 'Vui lòng không để trống email')->withInput();
            if (empty($request->get('phone')))
                return redirect()->back()->with('error', 'Vui lòng không để trống số điện thoại')->withInput();
            if (empty($request->get('web')))
                return redirect()->back()->with('error', 'Vui lòng không để trống link trang web')->withInput();
            if (empty($request->get('fanpage')))
                return redirect()->back()->with('error', 'Vui lòng không để trống link fanpage')->withInput();

            if (empty($request->get('google_map')))
                return redirect()->back()->with('error', 'Vui lòng không để trống google map')->withInput();
            if (empty($request->get('title_about_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới giơi thiệu')->withInput();
            if (empty($request->get('title_about_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng anh dưới giơi thiệu')->withInput();
            if (empty($request->get('title_project_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới dự án')->withInput();
            if (empty($request->get('title_project_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng anh dưới dự án')->withInput();
            if (empty($request->get('title_news_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới tin tức')->withInput();
            if (empty($request->get('title_news_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng anh dưới tin tức')->withInput();
            if (empty($request->get('title_gallery_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới thư viện')->withInput();
            if (empty($request->get('title_gallery_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng anh dưới thư viện')->withInput();
            if (empty($request->get('title_hot_news_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới tin tức nổi bật')->withInput();
            if (empty($request->get('title_hot_news_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng anh dưới tin tức nối bật')->withInput();
            if (empty($request->get('title_comment_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới đánh giá khách hàng')->withInput();
            if (empty($request->get('title_comment_en')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng anh dưới đánh giá khách hàng')->withInput();
            if (empty($request->get('title_partner_vi')))
                return redirect()->back()->with('error', 'Vui lòng không để trống tiêu đề tiếng việt dưới đối tác')->withInput();
            if (empty($request->get('title_partner_en')))
                return redirect()->back()->with('error', 'Vui lòng không để tiêu đề tiếng anh dưới đối tác')->withInput();
            if (empty($request->get('meta_title')))
                return redirect()->back()->with('error', 'Vui lòng không để trống meta title')->withInput();
            if (empty($request->get('meta_keysword')))
                return redirect()->back()->with('error', 'Vui lòng không để trống meta keysword')->withInput();
            if (empty($request->get('meta_des')))
                return redirect()->back()->with('error', 'Vui lòng không để trống meta description')->withInput();
            if (empty($request->get('google_analytics')))
                return redirect()->back()->with('error', 'Vui lòng không để trống google analytics')->withInput();

            $setting = SystemConfig::first();
            $setting->google_plus = $request->google_plus;
            $setting->viber = $request->viber;
            $setting->youtube = $request->youtube;
            $setting->facebook = $request->facebook;
            $setting->name_vi = $request->name_vi;
            $setting->name_en = $request->name_en;
            $setting->email_header = $request->email_header;
            $setting->phone = $request->phone;
            $setting->address_vi = $request->address_vi;
            $setting->address_en = $request->address_en;
            $setting->email = $request->email;
            $setting->hotline = $request->hotline;
            $setting->web = $request->web;
            $setting->fanpage = $request->fanpage;
            $setting->google_map = $request->google_map;
            $setting->title_about_vi = $request->title_about_vi;
            $setting->title_about_en = $request->title_about_en;
            $setting->title_project_vi = $request->title_project_vi;
            $setting->title_project_en = $request->title_project_en;
            $setting->title_news_vi = $request->title_news_vi;
            $setting->title_news_en = $request->title_news_en;
            $setting->title_gallery_vi = $request->title_gallery_vi;
            $setting->title_gallery_en = $request->title_gallery_en;
            $setting->title_hot_news_vi = $request->title_hot_news_vi;
            $setting->title_hot_news_en = $request->title_hot_news_en;
            $setting->title_comment_vi = $request->title_comment_vi;
            $setting->title_comment_en = $request->title_comment_en;
            $setting->title_partner_vi = $request->title_partner_vi;
            $setting->title_partner_en = $request->title_partner_en;
            $setting->partner_invester_vi = $request->partner_invester_vi;
            $setting->partner_invester_en = $request->partner_invester_en;
            $setting->partner_connect_vi = $request->partner_connect_vi;
            $setting->partner_connect_en = $request->partner_connect_en;
            $setting->partner_bank_vi = $request->partner_bank_vi;
            $setting->partner_bank_en = $request->partner_bank_en;
            $setting->meta_title = $request->meta_title;
            $setting->meta_keysword = $request->meta_keysword;
            $setting->meta_des = $request->meta_des;
            $setting->google_analytics = $request->google_analytics;
            $setting->save();
            return redirect()->back()->with(['success' => 'Cập nhật thành công!!']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Cập nhật thất bại!!'])->withInput();
        }
    }

}