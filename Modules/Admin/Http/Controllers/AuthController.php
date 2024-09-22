<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {

    }
    public function login()
    {
        return view('admin::auth.login');
    }

    public function process_login(Request $request)
    {
        // Validate the form data
        // $request->validate($request, [
        //     'email'   => 'required|email',
        //     'password' => 'required|min:6'
        // ]);
        // Attempt to log the user in
        // if (Auth::guard('admin')->attempt(['user_name' => $request->email, 'password' => $request->password])) {
        //     // if successful, then redirect to their intended location
        //     return redirect()->intended(route('admin.index'));
        // }
        $user_name  = $request->email;
        if (Auth::guard('admin')->attempt(
            ['user_name' => function ($query) use ($user_name ) {
                   $query->where('user_name', $user_name)->where("activated",1);
            },'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.index'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route("admin.user.login"));
    }
}
