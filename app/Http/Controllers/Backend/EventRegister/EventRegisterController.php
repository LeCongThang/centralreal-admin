<?php

namespace App\Http\Controllers\Backend\EventRegister;

use App\Models\EventRegister;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventRegisterController extends Controller
{
    //
    public function getAll(){
        try{
            $events=News::with('client_register')->where('post_type',0)->orderByDesc('updated_at')
                ->get();
            return view('backend.event_register.index',[
                'event'=>$events
            ]);
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
    public function getClient($id){
        try{
            $events=News::find($id);
            $clients=EventRegister::where('event_id',$id)->orderByDesc('updated_at')
                ->get();
            return view('backend.event_register.list_client',[
                'event'=>$events,
                'clients'=>$clients
            ]);
        }catch (\Exception $e){
            dd($e);
            return redirect('error');
        }
    }
}
