<?php

/**
 * Created by PhpStorm.
 * User: ThangLe
 * Date: 7/5/2018
 * Time: 3:42 PM
 */

namespace App\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class UpdateContactController extends Controller
{
    public function Edit($id){
        try{
            $contact=Contact::find($id);
            if($contact){
                return view('backend.contact.detail',[
                    'contact'=>$contact,
                ]);
            }else{
                return redirect('error');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function Update($contact_id,Request $request){
        try{
            $contact=Contact::find($contact_id);
            if($contact){
                $contact->status=$request->status;
                if($contact->save()){
                    return redirect()->back()->with('success','Cập nhật thành công!');
                }else{
                    return redirect()->back()->with('error','Cập nhật không thành công!');
                }
            }else{

                return redirect('error');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}