<?php


namespace App\Services\Zalo;

// use App\Models\Hyperspace\UserSetting;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Helpers\LogHelper;

class ZNS
{
    protected $application = null;
    protected $key = null;
    protected $baseUri = 'https://business.openapi.zalo.me/message/template';
    protected $tokenUri = 'https://oauth.zaloapp.com/v4/oa/access_token';
    protected $routePrefix;
    protected $redirectUri;
    protected $accessToken;
    protected $refreshToken;
    protected $options = [];
    protected $template_data = [];
    protected $template_id;
    public function __construct(array $options = [])
    {
        // $this->accessToken = "XqI_4_VNsrIAJxqG-DJRKebEkH_xohmIroIPEDxRb3p9EAeCuUUJ7EyQYGkTxxKXz72A0jgDd1_fTQq2yhk0H_rPY4NicB9qn7IaOhFldIx4VAKjvQR7CibB-0Z4llPFj7pJKQ7bt5sW8R9QhjoNPeaWjpx_twHcp0stLixTZs7mBwj5rU-F2EKTjakIv9Xqb3-gQ8-ihKAyMRn0hPA2UfDLl4sYg9jDfsgKMh6HiK6pVOi2WOQL8PPQi1MsfgLMWrwA5vMhfmcpOyLFZwN6Q9bzydcleE5gcKlRQQwum2gjUEvkkBpOLAnPt6sCWDyWYqdS4e3KnZY6AV06IqIgLtNtmDbV";

        $this->accessToken = user_config("access_token");
        // if($this->accessToken == "")
        // {
        //     $this->accessToken = $this->getAuthToken();
        //     LogHelper::write($this->accessToken,  "Get_eSMS_ToKen");
        // }
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
        // $this->options['headers']['Authorization'] = 'APIKey ' . base64_encode("access_token:".$this->accessToken);
        $this->template_id = "329388"; //user_config("zalo_zns_template_id");
        $this->template_data = ["otp"];
        $this->options['headers']['access_token'] = $this->accessToken;
        $this->options['headers']['Content-Type'] = "application/json";
    }

    public function format_option($options = [])
    {
        if (!isset($options['phone'])) {
            return ['error' => true, "message" => "Phone is valid"];
        }

        $data = [];
        foreach ($this->template_data as $key) {
            $data[$key] = $options[$key];
        }

        $result = [
            "phone" => "84" . $options['phone'],
            "template_id" => $this->template_id,
            "template_data" => $data,
            "tracking_id" => "tracking_id"
        ];
        return ['error' => false, 'data' => $result];
    }

    public function testConnect()
    {
        set_time_limit(0);
        try {
            $options = [
                "phone" => "123456789",
                "otp" => "123456"
            ];
            $res = $this->request('POST', $this->tokenUri, $options);
            dd($res);
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

    public function validateSetting($includeRefreshToken = false)
    {
        if (!$this->accessToken || !$this->template_id || empty($this->template_data)) {
            return false;
        }
        // if($includeRefreshToken && !$this->refreshToken) {
        //     return false;
        // }
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
        if (!preg_match('/^http/', $uri)) {
            $uri = $this->baseUri . $uri;
        }
        try {
            if (!$this->validateSetting(true) && false) {
                return $this->settingError();
            }

            if (!empty($options)) {
                $validOption = $this->format_option($options);
                if (!$validOption['error']) {
                    $options = $validOption["data"];
                } else {
                    return $validOption;
                }
            }
            $finalOptions = array_merge($this->options, ['json' => $options]);
            if (strpos($uri, '?') !== false) {
                unset($finalOptions['query']);
            }
            $client = new GuzzleHttpClient();
            $response = $client->request($method, $uri, $finalOptions);
            $result = $this->formatResponse($response);
			return $result;
            if ($result['code'] == "-124") {
                //$this->refreshToken();
            }
            return $result;
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    protected function formatResponse($response)
    {
        $code = $response->getStatusCode();
        $message = $response->getReasonPhrase();
        $body = $response->getBody();
        $data = json_decode($body, true);
        $headers = $response->getHeaders();
        if (isset($data["data"])) {
            return [
                'success' => true,
                'code' => $code,
                'message' => @$data["message"] ?? "error",
                'data' => $data["data"] ?? $data,
                'headers' => $headers
            ];
        } else {
            return [
                'success' => true,
                'code' => $data['error'],
                'message' => @$data["message"],
                'headers' => $headers
            ];
        }
    }

    protected function formatException($exception)
    {
        if (method_exists($exception, 'getResponse')) {
            $response = $exception->getResponse();
        }
        $body = !empty($response) ? $response->getBody(true)->getContents() : '';
        $jsonBody = json_decode($body, true);
        if ($body && !$jsonBody) {
            $jsonBody = $body;
        }
        return [
            'success' => 0,
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'data' => $jsonBody
        ];
    }

    public function getAuthToken()
    {
        $options = [
            'json' => [
                'email' => user_setting("eSMS_email"),
                'password' => user_setting("eSMS_password")
            ]
        ];
        $client = new GuzzleHttpClient();
        $response = $client->request('POST', $this->tokenUri, $options);
        $res = $this->formatResponse($response);
        return \Arr::get($res, "data.data.token");
    }

    public function refreshToken($authCode)
    {

        try {
            // $options = [
            //     'form_params' => [
            //         'grant_type' => 'authorization_code',
            //         'code' => $authCode,
            //         'redirect_uri' => $this->redirectUri,
            //         'approval_prompt' => 'force'
            //     ],
            //     'auth' => [$this->application , $this->key]
            // ];
            $options = [
                'form_params' => [
                    'app_id' => '2241680690692509014',
                    'code' => $authCode,
                    'grant_type' => 'authorization_code',
                    'code_verifier' => '',
                ],
                'headers' => ['secret_key' => "H2oFRZQaGiXGlGXVeE3G"]
            ];
            //$options['headers']['secret_key'] = "H2oFRZQaGiXGlGXVeE3G";
            //  $options['headers']['Content-Type'] = "application/x-www-form-urlencoded";

            $client = new GuzzleHttpClient();
            $response = $client->request('POST', $this->tokenUri, $options);
            $data = json_decode($response->getBody(), true);

            if (@$data['refresh_token']) {
                $this->refreshToken = $data['refresh_token'];
                update_config("refesh_token", $this->refreshToken);
            }
            if (@$data['access_token']) {
                $this->accessToken = $data['access_token'];
                $this->options['headers']['access_token'] = $this->accessToken;
                update_config("access_token",  $this->accessToken);
            }
        } catch (\Throwable $exception) {
            LogHelper::write($exception->getMessage(), 'getRefreshToken::exception');

            $result = $this->formatException($exception);
        }
    }

    public function sendOTP($phone, $otp)
    {
        $options = [
            "phone" => $phone[0] != 0 ? $phone : substr($phone, 1, strlen($phone)),
            "otp" => $otp
        ];
        $res = $this->request('POST', $this->baseUri, $options);
        return $res;
    }

    function generateRandomString($length = 10, $isNumber = true)
    {
        if ($isNumber) {
            $str = "0123456789";
        } else {
            $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        return substr(str_shuffle(str_repeat($x = $str, ceil($length / strlen($x)))), 1, $length);
    }
}
