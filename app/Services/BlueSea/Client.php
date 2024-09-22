<?php


namespace App\Services\BlueSea;

use GuzzleHttp\Client as GuzzleHttpClient;
use App\Helpers\LogHelper;
use Modules\ChinfonMN\Model\BlueSea;
use App\Services\Phone\Carrier;
class Client
{
    protected $application = null;
    protected $key = null;
    protected $baseUri = 'http://sms.bluesea.vn:8077/Card/TopUpCard?wsdl';
    protected $options = [];
    protected $merchant_code = "";
    protected $code = [
       // Bảng mã lỗi từ nhà mạng
	0 => 'Nạp tiền thành công',
	-1  => 'Tham so khong hop le Tham số đầu vào không hợp lệ or null',
	-2  => 'Merchant_key chưa được khai báo. Cần liên hệ với phòng kỹ thuật phần mềm để thêm mới',
	-3  => 'Địa chỉ IP chưa được khai báo. Cần liên hệ với phòng kỹ thuật phần mềm để thêm mới',
	-4  => 'Account của CP đã bị khóa. Liên hệ với phòng kỹ thuật phần mềm',
	-99  => 'Mã lỗi xảy ra trong quá trình xử lý',
	2 => 'Hệ thống nạp tiền nhà mạng đang tạm dừng, vui lòng thử lại sau 5 phút',
	3 => 'Nạp tiền không thành công, vui lòng kiểm tra lại hoặc liên hệ nhà mạng để biết thông tin',
	4 => 'Nạp tiền không thành công. Số tiền trong tài khoản topup không đủ, vui lòng thông báo lại cho công ty',
	5 => 'Nạp tiền không thành công, thuê bao đã bị khóa chức năng nạp thẻ. Vui lòng liên hệ nhà mạng để biết chi tiết',
	6 => 'Hết cổng giao dịch, vui lòng thử lại sau 1 phút',
	7 => 'Nạp tiền không thành công. Lỗi cổng nạp tiền, vui lòng thử lại sau 1 phút',
	8 => 'Số điện thoại nạp tiền không đúng, vui lòng kiểm tra lại',
	9 => 'Số tiền nạp không hợp lệ, vui lòng kiểm tra lại',
	12 => 'Hết cổng giao dịch, vui lòng thử lại sau 1 phút',
	13 => 'Số điện thoại chưa hỗ trợ, vui lòng kiểm tra lại',
	14 => 'Không xác định được số điện thoại',
	15 => 'Chưa nhận được kết quả từ nhà mạng (Giao dịch nghi vấn, vui lòng kiểm tra thuê bao nạp tiền)',
	16 => 'Số điện thoại nạp tiền đang tạm khóa để thực hiện thanh toán cho giao dịch trước, vui lòng nạp Vinaphone, Mobifone trả sau cách nhau 3 phút mỗi lần giao dịch',
	17 => 'Chưa nhận được kết quả từ nhà mạng (Giao dịch nghi vấn, vui lòng kiểm tra thuê bao nạp tiền)',
	18 => 'Kết quả phản hồi không có nội dung',
	19 => 'Sai số PIN giao dịch',
	20 => 'Lỗi trùng giao dịch vủa Viettel, vui lòng thử lại sau 5 phút hoặc tạm thời mua mã thẻ để nạp tiền',
	21 => 'Thanh toán trả sau Viettel không thành công',
	22 => 'Số điện thoại nạp tiền chưa kích hoạt',
	23 => 'Hệ thống thanh toán trả sau Vinaphone đang bận, vui lòng thử lại sau 5 phút',
	24 => 'Hệ thống nạp tiền Viettel đang tạm dừng để chốt cước, quý khách tạm thời mua mã thẻ để nạp tiền hoặc thử lại sau 15 phút',
	25 => 'Mã thẻ nạp tiền không hợp lệ, vui lòng thử lại sau 5 phút',
	26 => 'Thuê bao nhận chưa có tài khoản EZPay, vui lòng hướng dẫn đăng ký EZPay bằng cách nhắn tin EZPAY gửi 9888',
	27 => 'Mã PIN giao dịch đã bị hết hạn, vui lòng thông báo cho bộ phận kỹ thuật',
	28 => 'Sai số PIN giao dịch, vui lòng thông báo cho bộ phận kỹ thuật',
	29 => 'Lỗi trùng giao dịch vủa Vinaphone, vui lòng thử lại sau 5 phút hoặc tạm thời mua mã thẻ để nạp tiền',
	80 => 'Giao dịch nghi vấn, vui lòng liên hệ nhà mạng để kiểm tra',
	81 => 'Giao dịch nghi vấn, vui lòng liên hệ nhà mạng để kiểm tra',
	82 => 'Giao dịch đã được ghi nhận và đang trong quá trǹ h xử lý. Vui lòng kiểm tra lịch sử giao dịch để biết kết quả nạp tiền.',
	95 => 'Giao dịch đã được hoàn tiền (Mã lỗi xảy ra khi giao dịch trước bị lỗi 15,80,81,82,99 và không thành công)',
	96 => 'Dịch vụ tạm dừng để nâng cấp, quý khách vui lòng quay trở lại sau ít phút hoặc tạm thời mua mã thẻ nạp tiền',
	97 => 'Số tiền trong tài khoản không đủ hoặc không trừ được tài khoản',
	98 => 'Tài khoản đã bị kick, cần đăng nhập lại',
	99 => 'Giao dịch nghi vấn, lỗi chưa xác định. Vui lòng liên hệ nhà mạng để kiểm tra'
    ];
    public function __construct(array $options = [])
    {
	ini_set('display_errors', true);
	ini_set("soap.wsdl_cache_enabled", "0");
	error_reporting(E_ALL);

	header("Access-Control-Allow-Origin: http://example.com");
	header("Access-Control-Request-Method: GET,POST");
	$this->merchant_code = "CHINFON@@)@";
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

    public function request($options = [], $mode = 1, $id = null)
    {
	try {

	    $uri = $this->baseUri;
	    $carrier =  new Carrier();
	    $provider = $carrier->getProvider($options['phone']);
	    $data = [
		'User_ID' => $options['phone'],
		"Amount" => $options['amount'],
		"provider" => $provider,
		"mode" => $mode,
		"merchant_code" => $this->merchant_code
	    ];

	    $soapclient = new \SoapClient($uri);
	    $response = $soapclient->TopUpCard($data);
	    $result = $this->Decrypt($response->return, "chinFon)@@*@)@#");

	    // if($id != null)
	    // {
	    //     $bluesea =  BlueSea::where("id",$id)->first();
	    //     $bluesea->mode = $data['mode'];
	    //     $bluesea->response = json_encode($response);
	    //     $bluesea->result = $result;
	    //     $bluesea->save();
	    // }
	    // else{

	    $result_format = $this->formatResponse($result);
		$bluesea = new BlueSea();
		$bluesea->user_id = $data['User_ID'];
		$bluesea->amount = $data['Amount'];
		$bluesea->provider = $data['provider'];
		$bluesea->mode = $data['mode'];
		$bluesea->response = json_encode($response);
		$bluesea->result = $result;
		$bluesea->code =  $result_format['code'];
		$bluesea->message =  $result_format['message'];
		$bluesea->token  = @$options['token'];
		$bluesea->save();
	    // }
	    return (object)array_merge(['topup'=>$bluesea->id], $result_format );
	} catch (\SoapFault $exception) {

	}

    }

	

    protected function formatResponse($response) {
	$code = explode("|",$response);
	return [
	    'success' =>  $code[0]==0?1:0,
	    'code' => $code[0],
	    'message' => \Arr::get($this->code, $code[0]),
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

    public function demo($option)
    {
	if(empty($option['phone']) || empty($option['provider']))
	{
	    return "phone or provider is invalid";
	}
	$data = [
	    'User_ID' => $option['phone'],
	    "Amount" => "5000",
	    "provider" => $option['provider'],
	    "mode" => 1,
	    "merchant_code" => "CHINFON@@)@"
	];
	header("Access-Control-Allow-Origin: http://example.com");
	header("Access-Control-Request-Method: GET,POST");

	ini_set('display_errors', true);
	ini_set("soap.wsdl_cache_enabled", "0");
	error_reporting(E_ALL);


	try {
	    $soapclient = new \SoapClient($this->baseUri);
	    $response = $soapclient->TopUpCard($data);
	    $res = $this->Decrypt($response->return, "chinFon)@@*@)@#");

	} catch (SoapFault $e) {

	}
    }
    function Encrypt($input, $key_seed)
    {
	$input = trim($input);
	$block = mcrypt_get_block_size('tripledes', 'ecb');
	$len = strlen($input);
	$padding = $block - ($len % $block);
	$input .= str_repeat(chr($padding), $padding);
	// generate a 24 byte key from the md5 of the seed
	$key = substr(md5($key_seed), 0, 24);
	$iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	// encrypt
	$encrypted_data = mcrypt_encrypt(
	    MCRYPT_TRIPLEDES,
	    $key,
	    $input,
	    MCRYPT_MODE_ECB,
	    $iv
	);
	// clean up output and return base64 encoded
	return base64_encode($encrypted_data);
    }

    function Decrypt($input, $key_seed)
    {
	$input = base64_decode($input);
	$key = substr(md5($key_seed), 0, 24);
	$text = mcrypt_decrypt(
	    MCRYPT_TRIPLEDES,
	    $key,
	    $input,
	    MCRYPT_MODE_ECB,
	    '12345678'
	);
	$block = mcrypt_get_block_size('tripledes', 'ecb');
	$packing = ord($text{
	strlen($text) - 1});
	if ($packing and ($packing < $block)) {
	    for ($P = strlen($text) - 1; $P >= strlen($text) - $packing; $P--) {
		if (ord($text{
		$P}) != $packing) {
		    $packing = 0;
		}
	    }
	}
	$text = substr($text, 0, strlen($text) - $packing);
	return $text;
    }


	public function napbangtay($options = [], $mode = 1, $id = null)
    {
		try {

			$uri = $this->baseUri;
			$carrier =  new Carrier();
			$provider = $carrier->getProvider($options['phone']);
			$data = [
			'User_ID' => $options['phone'],
			"Amount" => $options['amount'],
			"provider" => $options['provider'],
			// "provider" => $provider,
			"mode" => $mode,
			"merchant_code" => $this->merchant_code
			];
			$soapclient = new \SoapClient($uri);
			$response = $soapclient->TopUpCard($data);
			$result = $this->Decrypt($response->return, "chinFon)@@*@)@#");

			// if($id != null)
			// {
			//     $bluesea =  BlueSea::where("id",$id)->first();
			//     $bluesea->mode = $data['mode'];
			//     $bluesea->response = json_encode($response);
			//     $bluesea->result = $result;
			//     $bluesea->save();
			// }
			// else{

			// $result_format = $this->formatResponseSMS($result); // lay the cao 
			$result_format = $this->formatResponse($result); // nap top up
			
			// }
			return $result_format;
			// return (object)array_merge(['topup'=>'1'], $result_format );
		} catch (\SoapFault $exception) {

		}
    }

	protected function formatResponseSMS($response) 
	{
		$code = explode("|",$response);
		return [
			'success' =>  $code[0]==0?1:0,
			'code' => $code[0],
			'message' => \Arr::get($this->code, $code[0]),
			'card_id' => $code[2],
		];
	}

}
