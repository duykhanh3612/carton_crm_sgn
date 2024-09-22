<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if($request->route()->getPrefix()=="/admin")
        {
            $route =  route('admin.user.login');
        }
        elseif($request->route()->getPrefix()=="/api")
        {

            // echo response(['Token is invalid'], 401);
            echo json_encode([
                'status' => 'false',
                'message' => 'Unauthorized','code'=>401]);
            die;
        }
        else{
           $route =  route('login');
        }

        if (! $request->expectsJson()) {
            return $route;
        }
    }
}
