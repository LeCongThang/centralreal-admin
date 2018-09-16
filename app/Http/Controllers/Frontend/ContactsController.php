<?php
/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/10/2018
 * Time: 11:26 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\EventRegister;
use App\Models\News;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function postContact(Request $request)
    {
        try{
            $data = $request->all();
            $contact = new Contact();
            $contact->name=$data['name'];
            $contact->phone=$data['phone'];
            $contact->email=$data['email'];
            $contact->title=$data['title'];
            $contact->content=$data['content'];
            $contact->client_ip=$request->ip();
            if($contact->save()){
                $email = 'marketing@ccr.vn';
                $result = Mail::send('backend.send_mail_contact', array(
                    'contact' => $contact,
                ), function ($message) use ($email) {
                    $message->to([$email]);
                    $message->from(env('MAIL_USERNAME'));
                    $message->subject('CENTRAL REAL');
                });
                return response()->json([
                    'data' => $contact,
                    'message' => 'Success'
                ])->setStatusCode('200', 'Success');
            }else{
                return response()->json([
                    'data' => [],
                    'message' => 'Data Not found'
                ])->setStatusCode('404', 'Not found');
            }
        }catch (\Exception $e){
            dd($e);
            return response()->json([
                'data' => [],
                'message' => 'Data Not found'
            ])->setStatusCode('404', 'Not found');
        }

    }

    public function registerEvent(Request $request)
    {
        try{
            $data = $request->all();
            $register_event = new EventRegister();
            $register_event->event_id=$data['event_id'];
            $register_event->name=$data['name'];
            $register_event->phone=$data['phone'];
            $register_event->email=$data['email'];
            if($register_event->save()){
                $event = News::find($data['event_id']);
                $email = 'marketing@ccr.vn';
                $result = Mail::send('backend.send_mail_event', array(
                    'event' => $event,
                    'register_event' => $register_event,
                ), function ($message) use ($email) {
                    $message->to([$email]);
                    $message->from(env('MAIL_USERNAME'));
                    $message->subject('CENTRAL REAL');
                });
                return response()->json([
                    'data' => $register_event,
                    'message' => 'Success',
                ])->setStatusCode('200', 'Success');
            }else{
                return response()->json([
                    'data' => [],
                    'message' => 'Data Not found'
                ])->setStatusCode('404', 'Not found');
            }
        }catch (\Exception $e){
            dd($e);
            return response()->json([
                'data' => [],
                'message' => 'Data Not found'
            ])->setStatusCode('404', 'Not found');
        }
    }
}