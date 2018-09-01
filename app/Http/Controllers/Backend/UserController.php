<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();
        return view('backend.user.profile',compact('user'));
    }

    public function index()
    {
        if(!Auth::user()->role_id)
            return redirect()->back()->with('flash','Bạn không có quyền truy cập vào trang vừa chọn.');
        $users = User::orderByDesc('role_id')->orderByDesc('created_at')->get();
        return view('backend.user.list',compact('users'));
    }

    public function create()
    {

        if(!Auth::user()->role_id)
            return redirect()->back()->with('flash','Bạn không có quyền truy cập vào trang vừa chọn.');
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        if(!Auth::user()->role_id)
            return redirect()->back()->with('flash','Bạn không có quyền truy cập vào trang vừa chọn.');

        $rules = [
            'fullname' => 'required',
            'email' => 'required|email|unique:user,email',
        ];
        $messages = [
            'fullname.required' => 'Họ tên không được để trống',

            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã tồn tại trong cơ sở dữ liệu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $pass = trim($request['password']);
        if(!empty($pass) && strlen($pass) < 6)
            return redirect()->back()->withInput()->with('error','Mật khẩu bỏ trống nếu muốn đặt trùng với email hoặc nhập ít nhất 6 kí tự nếu muốn đặt mới');

        $user = new User();
        $user->password = empty($pass) ? trim($request['email']) : $pass;
        $user->role_id = $request['role_id'];
        $user->fullname = $request['fullname'];
        $user->email = $request['email'];
        $user->status = $request['status'];
        if($user->save())
            return redirect($request->save)->with('success','Đã thêm người dùng thành công!');
        return redirect()->back()->withInput()->with('error','Đã xảy ra lỗi khi thêm người dùng, vui lòng thử lại!');
    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {
        if(!Auth::user()->role_id)
            return redirect()->back()->with('flash','Bạn không có quyền truy cập vào trang vừa chọn.');
        return view('backend.user.edit',compact('user'));
    }

    public function update($id,Request $request)
    {
        $rules = [
            'fullname' => 'required',
            'email' => 'required|email',
        ];
        $messages = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'fullname.required' => 'Họ tên không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $pass = trim($request->get('password'));
        if(!empty($pass) && strlen($pass) < 6)
            return redirect()->back()->with('error','Mật khẩu bỏ trống nếu không muốn thay đổi hoặc nhập ít nhất 6 kí tự nếu muốn đổi mới');

        $redirectTo = 'user';

        $user=User::find($id);
        if(!empty($request->get('profile')))
        {
            $user = Auth::user();
            $redirectTo = 'profile';
        }
        else
        {
            if(!Auth::user()->role_id)
                return redirect()->back()->with('flash','Bạn không có quyền truy cập vào trang vừa chọn.');

            $user->status = $request->get('status');
            $user->role_id = (int)$request->get('role_id');
        }

        $email = $request->get('email');
        if(User::where('email',$email)->where('id',"!=",$id)->exists() && $email != $user->email)
            return redirect()->back()->with('error','Email này đã tồn tại trong hệ thống');

        if(!empty($pass))
            $user->password = $pass;

        $user->fullname = $request->get('fullname');
        $user->email = $email;

        if($user->save())
            return redirect($redirectTo)->with('success','Đã cập nhật thông tin thành công!');
        return redirect()->back()->with('error','Đã xảy ra lỗi khi cập nhật thông tin người dùng, vui lòng thử lại!');
    }

    public function destroy(User $user)
    {
        if(!Auth::user()->role_id)
            return ['status'=>0,'stt'=>"Bạn không có quyền xóa người dùng này!"];

        if ($user->delete())
            return ['status'=>1,'stt'=>"Đã xóa người dùng <b>$user->fullname</b> thành công!"];
        return ['status'=>0,'stt'=>"Đã xảy ra lỗi trong quá trình xóa người dùng, vui lòng thử lại sau!"];
    }
}
