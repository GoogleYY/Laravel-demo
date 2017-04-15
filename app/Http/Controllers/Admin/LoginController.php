<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use Session;

class LoginController extends Controller
{

    public function loginView()
    {
        return view('admin.login');
    }

    public function loginPost()
    {
        $user = \DB::table('admins')
            ->first();

        if($admin = request()->all()) {

            if ($user->name != $admin['username'] || Crypt::decrypt($user->password) != $admin['password']) {
                return back()->with('msg', '用户名或密码错误');
            }
            session(['admin' => $user]);
            return redirect(
                session('requestUri') && strpos(session('requestUri'), 'admin/login') === false ? session('requestUri') : 'admin/dash');
        } else {
            return view('admin.login');
        }
    }

    public function logout()
    {
        Session::forget('admin');

        if (!session('admin')) {
            return back()->with('msg', '退出失败');
        }

        return view('admin.login');
    }

    public function passModifyView()
    {
        return view('admin.passmodify');
    }

    public function passModifyPost()
    {
        if ($req = request()->all()) {

            $validator = Validator::make($req, [
                'password_old' => 'required',
                'password' => 'required|between:6,20|confirmed',
            ], [
                'password_old.required' => '旧密码不能为空',
                'password.required' => '新密码不能为空',
                'password.between' => '新密码必须在6-20位之间',
                'password.confirmed' => '两次输入的密码不匹配',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            } else {
                $user = \DB::table('user')->first();
                if ($req['password_old'] == Crypt::decrypt($user->user_password)) {
                    $user->user_password = Crypt::encrypt($req['password']);
                    $user->update();
                    return redirect('admin/info');
                } else {
                    return back()->with('errors', '旧密码错误 !');
                }
            }
        } else {
            return view('admin.passmodify');
        }
    }

}
