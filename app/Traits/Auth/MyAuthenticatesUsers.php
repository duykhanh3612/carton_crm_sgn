<?php

namespace App\Traits\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

trait MyAuthenticatesUsers
{
    use AuthenticatesUsers;

    public function showLoginForm() {
        return view($this->_loginView,
            array(
                'pageTitle' => $this->_pageTitle,
                'image'     => Config::get($this->_imageKey),
                'prefix'    => $this->_prefix
            )
        );
    }

    public function login(Request $request) {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function checkExist(Request $request) {
        $exist = $this->_model->where($this->username(), $request->user_name)->first();

        return $exist;
    }

    public function username() {
        return $this->_userNameKey;
    }

    protected function validateLogin(Request $request) {
        $request->validate($this->_model->createRule($this->username()));
    }

    protected function credentials(Request $request) {
        $credentials = $request->only($this->username(), 'password');

        if ($this->_guard != Config::get('constants.guard.admin')) {
            $credentials = array_merge($credentials, array('approved' => 1));
        }

        return $credentials;
    }

    public function logout(Request $request) {
        $this->guard()->logout();

        return $this->loggedOut($request) ?: redirect('/');
    }

    protected function loggedOut(Request $request) {
        return redirect()->route($this->_prefix . 'get.login');
    }

    protected function guard() {
        return Auth::guard($this->_guard);
    }
    
    protected function authenticated(Request $request, $user)
    {
        $guard = $this->_guard == 'user' ? '' : $this->_guard;
        return redirect('/' . $guard);
    }
}
