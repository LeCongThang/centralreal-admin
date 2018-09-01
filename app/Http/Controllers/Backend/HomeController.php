<?php

namespace App\Http\Controllers\Backend;

use App\Models\ClientFeedback;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()){
            $news=News::where('post_type',1)->count();
            $event=News::where('post_type',0)->count();
            $project=Project::count();
            $partner=Partner::count();
            $contact=Contact::count();
            $gallery=Gallery::count();
            $recruitment=Recruitment::count();
            $feedback=ClientFeedback::count();
            return view('backend.home',[
                'news'=>$news,
                'event'=>$event,
                'project'=>$project,
                'partner'=>$partner,
                'contact'=>$contact,
                'gallery'=>$gallery,
                'recruitment'=>$recruitment,
                'feedback'=>$feedback
            ]);
        }
        return redirect('login');
    }
    public function Error()
    {
        return view('backend.partial.404');
    }
}
