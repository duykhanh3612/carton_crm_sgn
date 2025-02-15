<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Modules\Freelancer\Model\UserProfile;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            [
                'except' => [
                    'login', 'loginCallback', 'google', 'getGoogleSignInUrl'
                ]
            ]
        );
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param $request Request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        if (!empty($request->token)) {
            $token =  $request->token;
            $crypt =  Crypt::decryptString($token);
            $data = json_decode($crypt);
            $user = User::where('email', $data->email)->where("google_id", $data->google_id)->first();
            if (!empty($user) && $token = $this->guard('api')->login($user)) {
                return $this->respondWithToken($token);
            } else {
                get_response_code(false, 401, $result, 'Unauthorized');
                return $result;
            }
        } else {
            $credentials = $request->only('phone', 'password');
            if ($token = $this->guard('api')->attempt($credentials)) {
                return $this->respondWithToken($token);
            }
        }
        get_response_code(false, 401, $result, 'Unauthorized');
        return $result;
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'type' => $this->guard('api')->user()->user_type,
            'expires_in' => $this->guard('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

    public function google(Request $request)
    {
        try {
            $url = Socialite::driver('google')->stateless()
                ->redirect()->getTargetUrl();
            return redirect($url);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
    public function getGoogleSignInUrl()
    {
        try {
            $url = Socialite::driver('google')->stateless()
                ->redirect()->getTargetUrl();
            return response()->json([
                'url' => $url,
            ])->setStatusCode(200);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
    public function loginCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();
            if (empty($user)) {
                $user = User::create(
                    [
                        'email' => $googleUser->email,
                        'full_name' => $googleUser->name,
                        'google_id' => $googleUser->id,
                        'user_type' => 2,
                        'is_approved' => 0
                    ]
                );
            } else {
                User::updateOrCreate(
                    [
                        'email' => $googleUser->email,
                    ],
                    [
                        'full_name' => $googleUser->name
                    ]
                );
            }
            UserProfile::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'avatar' => $googleUser->avatar
                ]
            );
            $crypt['email'] = $googleUser->email;
            $crypt['name'] = $googleUser->name;
            $crypt['google_id'] = $googleUser->id;
            $token = Crypt::encryptString(json_encode($crypt));
            return response()->json(['token' => $token]);
        } catch (\Throwable $e) {
            log_helper($e->getMessage(), 'AuthException');
            return response()->json(
                [
                    'status' => __('google sign in failed'),
                    'error' => $e,
                    'message' => $e->getMessage(),
                ]
            );
        }
    }
}
