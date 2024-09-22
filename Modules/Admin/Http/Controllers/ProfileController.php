<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use  Modules\Admin\Model\Users;

class ProfileController extends BaseController
{
    function account()
    {
        $data = [];
        return \Themes::view("admin::user.account", $data);
    }

    function update(Request $request)
    {
        $user =  Users::where('id', auth()->user()->id)->first();
        if(empty($user))
        {
            return redirect()->route('admin.user.account')
            ->withErrors("Account not exist")
            ->withInput();
        }

        $user->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone
        ]);
        return redirect()->route('admin.user.account')->with('alert_message', 'Cập nhập thông tin thành công.');
    }

    function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|string|min:8|max:255|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.account')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $user =  Users::where('id', auth()->user()->id)->first();
            if(empty($user))
            {
                return redirect()->route('admin.user.account')
                ->withErrors("Account not exist")
                ->withInput();
            }

            $user->update([
                'password' => Hash::make($request['password']),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.user.account')->with('errormsg', 'User creation failed.');
        }

        return redirect()->route('admin.user.account')->with('alert_message', 'Cập nhập mật khẩu thành công.');
    }
    function updateAvatar(Request $request)
    {
        $data = upload(request()->files, "upload/avatar");
        $user =  Users::where('id', auth()->user()->id)->first();
        $user->update([
            'avatar' => $data['file']
        ]);
        return json_encode($data);
    }
}
