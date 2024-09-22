<?php


namespace App\Services\Zalo;

// use App\Models\Hyperspace\UserSetting;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Helpers\LogHelper;

class Client
{
    protected $application = null;
    protected $key = null;
    protected $baseUri = 'http://api.omitopup.com/api/';
    protected $authUri = 'http://api.omitopup.com/api/getuserinfo';
    protected $tokenUri = 'http://api.omitopup.com/api/login';
    protected $routePrefix;
    protected $redirectUri;
    protected $accessToken;
    protected $refreshToken;
    protected $options = [];

    public function __construct(array $options = [])
    {
        // $this->routePrefix = config('constants.guard.add_on.channeladvisor');
        // $this->redirectUri = route($this->routePrefix . '.get.token.callback');
        // $this->application = config('constants.channel_advisor.application_id');
        // $this->key = config('constants.channel_advisor.share_key');
        // $this->refreshToken = hs_setting(config('constants.channel_advisor.refresh_token'));
        $this->accessToken = user_setting("eSMS_token");
        if($this->accessToken == "")
        {
            $this->accessToken = $this->getAuthToken();
            LogHelper::write($this->accessToken,  "Get_eSMS_ToKen");
        }
        // if ($this->application && $this->key) {
        //     $this->application = trim($this->application);
        //     $this->key = trim($this->key);
        // }
        // $this->options['body'] = [

        //         'email' => user_setting("eSMS_email"),
        //         'password' => user_setting("eSMS_password"),
        //         'token' => $this->accessToken

        // ];
        // $this->options['token'] = $this->accessToken;
        // $this->options['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
        $this->options['headers']['token'] = $this->accessToken;
    }

    public function setOptions($options = []){
        if(!empty($options)) {
            $this->options = array_merge_recursive($this->options , $options);
        }
        return $this->options;
    }

    public function testConnect()
    {
        set_time_limit(0);
        try {
            $res = $this->request('POST', $this->authUri);
            return $res;
            if ($res['success'] && $res['code']) {
                return $res;
            } else {
                // \LogHelper::write($res['message'], 'CONNECT FAILED MESSAGE');
                return 0;
            }
        } catch (\Throwable $ex) {
            LogHelper::write($ex->getMessage(), 'eSMS TEST CONNECT ERROR');
        }
    }

    public function validateSetting($includeRefreshToken = false){
        if(!$this->application || !$this->key) {
            return false;
        }
        if($includeRefreshToken && !$this->refreshToken) {
            return false;
        }
        return true;
    }

    public function settingError()
    {

        return [
            'success' => 0,
            'code' => 415,
            'message' => 'Missing setting',
            'data' => [
                'Application ID' => $this->application,
                'Share Key' => $this->key,
                'Refresh Token' => $this->refreshToken
            ]
        ];
    }

    public function request($method = 'GET', $uri = '', $options = [], $retried = 0)
    {
        if(!preg_match('/^http/' , $uri)) {
            $uri = $this->baseUri . $uri;
        }
        try {
            if(!$this->validateSetting(true) && false) {
                return $this->settingError();
            }
            // Merge with default options
            // $para['json'] = $this->options;

            // dd($this->options);
            $finalOptions = array_merge(  $this->options, $options);
            if(strpos($uri , '?') !== false) {
                unset($finalOptions['query']);
            }
            // dd($method, $uri , $finalOptions);
            $client = new GuzzleHttpClient();
            $response = $client->request($method, $uri , $finalOptions);
            $result = $this->formatResponse($response);

        } catch (\Throwable $exception) {
            // $result = $this->formatException($exception);
            // $retried++;
            // if($retried < 3) {
            //     if ($result['code'] == 429) {
            //         LogHelper::write('Sleep 60s because request reach the limit');
            //         sleep(60);
            //         return $this->request($method, $uri, $options , $retried);
            //     }
            //     if ($result['code'] == 401) {
            //         LogHelper::write('Try to update new access token');
            //         $updateAccessTokenResult = $this->updateAccessToken();
            //         if($updateAccessTokenResult['success']) {
            //             return $this->request($method, $uri, $options , $retried);
            //         }
            //         else {
            //             if(@$updateAccessTokenResult['data']['error'] === 'invalid_grant'){
            //                 UserSetting::query()->where('hs_key' , config('constants.channel_advisor.refresh_token'))->delete();
            //                 UserSetting::getAllSettings(true);
            //                 $this->refreshToken = null;
            //             }
            //         }
            //     }
            //     $options['timeout'] = 120;
            //     return $this->request($method, $uri, $options , $retried);
            // }
        }
        return $result;
    }

    protected function formatResponse($response) {
        $code = $response->getStatusCode();
        $message = $response->getReasonPhrase();
        $body = $response->getBody();
        $data = json_decode($body, true);
        $headers = $response->getHeaders();
        return [
            'success' => 1,
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'headers' => $headers
        ];
    }

    protected function formatException($exception) {
        if(method_exists($exception , 'getResponse')) {
            $response = $exception->getResponse();
        }
        $body = !empty($response) ? $response->getBody(true)->getContents() : '';
        $jsonBody = json_decode($body , true);
        if($body && !$jsonBody) {
            $jsonBody = $body;
        }
        return [
            'success' => 0,
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'data' => $jsonBody
        ];
    }

    public function getAuthToken(){
        $options = [
            'json' => [
                'email' => user_setting("eSMS_email"),
                'password' => user_setting("eSMS_password")
            ]
        ];
        $client = new GuzzleHttpClient();
        $response = $client->request('POST' , $this->tokenUri , $options);
        $res = $this->formatResponse($response);
        return \Arr::get($res,"data.data.token");
    }

    public function getRefreshToken($authCode){
        if(!$this->validateSetting(false)) {
            return $this->settingError();
        }
        if(!$authCode) {
            return [
                'success' => 0,
                'code' => 400,
                'message' => 'Authorization Code is invalid!',
                'data' => [
                    'Authorization Code' => $authCode,
                ]
            ];
        }
        try {
            $options = [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $authCode,
                    'redirect_uri' => $this->redirectUri,
                    'approval_prompt' => 'force'
                ],
                'auth' => [$this->application , $this->key]
            ];
            $client = new GuzzleHttpClient();
            $response = $client->request('POST' , $this->tokenUri , $options);
            $result = $this->formatResponse($response);
            if($result['success']){
                $data = $result['data'];
                if(@$data['refresh_token']) {
                    $this->refreshToken = $data['refresh_token'];
                    UserSetting::updateOrCreate(
                        ['hs_key' => config('constants.channel_advisor.refresh_token')] ,
                        ['hs_val' => $this->refreshToken]
                    );
                }
                if(@$data['access_token']) {
                    $this->accessToken = $data['access_token'];
                    $this->options['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
                    UserSetting::updateOrCreate(['hs_key' => config('constants.channel_advisor.access_token')] , ['hs_val' => $this->accessToken]);
                }
            }
        }
        catch (\Throwable $exception) {
            LogHelper::write($exception->getMessage() , 'getRefreshToken::exception');
            $result = $this->formatException($exception);
        }
        return $result;
    }

    public function updateAccessToken(){
        if(!$this->validateSetting(true)) {
            return $this->settingError();
        }
        try {
            $options = [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->refreshToken,
                ],
                'auth' => [$this->application , $this->key]
            ];
            $client = new GuzzleHttpClient();
            $response = $client->request('POST' , $this->tokenUri , $options);
            $result = $this->formatResponse($response);
            if($result['success']) {
                $this->accessToken = $result['data']['access_token'];
                $this->options['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
                UserSetting::updateOrCreate(['hs_key' => config('constants.channel_advisor.access_token')], ['hs_val' => $this->accessToken]);
            }
        }
        catch (\Throwable $exception) {
            LogHelper::write($exception->getMessage() , 'updateAccessToken::exception');
            $result = $this->formatException($exception);
        }
        return $result;
    }


    public function  topup($para)
    {
        $uri = "manage/cardcode";
        $res = $this->request("POST",$uri,$para);
        return $res;
    }

    public function cardcode($para)
    {
        $uri = "manage/cardcode";
        $res = $this->request("POST",$uri,$para);
        return $res;
    }


    public function manage_export($para)
    {
        $uri = "manage/export";
        $res = $this->request("POST",$uri,$para);
        return $res;
    }
}
