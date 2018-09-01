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

class ContactController extends Controller
{
    public function getAll(){
        try{
            $contact=Contact::where('is_delete',0)->orderByDesc('updated_at')
                ->get();
            return view('backend.contact.index',[
                'contact'=>$contact
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function deleteContact($id){
        try{
            $contact=Contact::find($id);
            return view('backend.contact.delete',[
                'contact'=>$contact
            ]);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function destroyContact($id){
        try{
            $contact=Contact::find($id);
            if($contact){
                $contact->is_delete=1;
                if($contact->save()){
                    return redirect()->back()->with('success','Xóa thành công!');
                }else{
                    return redirect()->back()->with('error','Xóa thất bại!');
                }
            }else{
                return redirect()->back()->with('error','Không tồn tại!');
            }
        }catch (\Exception $e){
            return redirect('error');
        }
    }
}