<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FinderController extends Controller
{
    //
    public function Folder($folder,Request $request)
    {
        $num = $request->query('CKEditorFuncNum');
        $manuals = [];
        $filesInFolder = \File::files('uploads/'.$folder);

        foreach ($filesInFolder as $path) {
            $manuals[] = pathinfo($path);
        }
//        dd($manuals);
        return view('backend.folder_'.$folder,
            [
                'num' => $num,
                'FileNames' => $manuals
            ]);
    }
    public function UploadFile($folder,Request $request)
    {
        $uploadedFileNames = [];
        if ($request->hasFile('uploadedImages')) {
            $files = $request->file('uploadedImages');
            if(count($files)>10){
                return ['error' => 'You can upload maximum 10 image in time.'];
            }
            else{
                $i=0;
                foreach ($files as $file) {
                    $file_name = md5(Carbon::now()).$i. '.jpg';
                    $file->move(public_path('/uploads/'.$folder.'/'), $file_name);

                    array_push($uploadedFileNames, $file_name);
                    $i++;
                }
            }
            return ['uploadedFileNames' => $uploadedFileNames,'folder'=>$folder];
        } else {
            return ['error' => 'Upload Fail '];
        }
    }
    public function RemoveFile($folder,$filename){
        $file= $filename.'.jpg';
        if($file){
            unlink(public_path('/uploads/'.$folder.'/').$file);
            return ['mgs'=>'success'];
        }
        else{
            return ['mgs'=>'fail'];
        }

    }
}
