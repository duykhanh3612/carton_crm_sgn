<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Model\Customer;
use Modules\Admin\Model\OTP;
use App\Services\Zalo\ZNS;
use Hash;
use Nette\Utils\Random;
use Validator;
use Response;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        // $validated = $request->validate([
        //     'phone' => 'required|unique:customers|max:255',
        //     'password' => 'required|max:255'
        // ]);
        $messages = [
            'password.required'  => 'Hãy điền vào phần mật khẩu.',
            'phone.unique'    => 'Số điện thoại đã được đăng ký',
            'unique' => ':attribute thì đã tồn tại',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required|unique:customers|max:255',
                'password' => 'required|max:255'
            ],
            $messages
        );
        if ($validator->fails()) {
            return response()->json(['code' => 200, 'success' => false, 'error' => $validator->messages()], 200);
        }
        $data = [
            // 'full_name'=> $request->full_name,
            'phone' => $request->phone,
            'type' => 2,
            // 'email'=> $request->email,
            // 'user_name' => $request->user_name
        ];

        if ($request->password) {
            $data['password'] = Hash::make(request("password"));
        }
        // $records = $query->fill($data)->save();

        $records = Customer::create($data);
        $result['data'] =  $records;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    function forgotPassword(Request $request)
    {
        $messages = [
            'phone.required'    => 'Số điện thoại khống chính xác',
            'phone.exists' => 'Số điện thoại không tồn tại',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required|exists:customers,phone|max:255'
            ],
            $messages
        );
        if ($validator->fails()) {
            return response()->json(['code' => 200, 'success' => false, 'error' => $validator->messages()], 200);
        }
        $phone = $request->phone;
        $customer = Customer::where('phone',  $phone)->first();
        $date = date('Y-m-d H:i:s');
        $check_otp = OTP::where("phone", $phone)->where("time_line", ">=", $date)->whereNull("status")->first();
        if (empty($check_otp)) {
            $zaloZns = new ZNS();
            $otp = $zaloZns->generateRandomString(6);
            OTP::where("phone", $phone)->whereNull("status")->update(['status' => "expiration"]);
            $new_otp = OTP::create(['phone' => $phone, 'code' => $otp, 'time_line' => date('Y-m-d H:i:s', strtotime('+5 minutes'))]);
            if (!empty($new_otp)) {
                $result = $zaloZns->sendOTP($phone, $otp);
                if($result['code'] == "200")
                {
                    $customer->update(['code' =>  $otp]);
                   //Send pass to OTP
                    $result['message'] =  "Otp đã được gửi tới số điện thoại của bạn. Xin hãy kiểm tra tin nhắn.";
                    $result['code'] = 200;
                    $result['success'] = true;
                    return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    //Send pass to OTP
                    $result['message'] =  "Thao tác thất bại";
                    $result['code'] = 200;
                    $result['success'] = false;
                    return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                }
            }

        }
        else{
            $result['message'] =  "Otp đã được gửi tới số điện thoại của bạn. Xin hãy kiểm tra tin nhắn.";
            $result['code'] = 200;
            $result['success'] = true;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
    function changePassword(Request $request)
    {
        $phone = $request->phone;
        $otp = $request->otp;

        $customer = Customer::where('phone', $phone)->first();
        if (empty($customer)) {
            $result['message'] = "Account not exist";
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        if ($customer->code != $otp) {
            $result['message'] = "Otp is valid";
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        $data['password'] = Hash::make(request("password"));
        OTP::where("phone", $phone)->where("code",$otp)->update(['status' => "used"]);
        $customer->update($data);
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    function updatePassword(Request $request)
    {
        $messages = [
            'password.required'  => 'Mật khẩu là bắt buộc',
            'confirm_password.required'    => 'Xác nhận mật khẩu là bắt buộc',
            'confirm_password.same' => 'Mật khẩu xác nhận không chính xác',
            'unique' => ':attribute thì đã tồn tại',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|max:255',
                'confirm_password' => 'required|max:255|same:password'
            ],
            $messages
        );
        if ($validator->fails()) {
            return response()->json(['code' => 200, 'success' => false, 'error' => $validator->messages()], 200);
        }


        $customer_id = auth('api')->user()->id;
        $customer = Customer::where('id', $customer_id)->first();
        if (empty($customer)) {
            $result['message'] = "Account not exist";
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        $data['password'] = Hash::make(request("password"));
        $customer->update($data);
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    function updateCustomer()
    {
        $customer_id = auth('api')->user()->id;
        $customer = Customer::where('id', $customer_id)->first();
        if (empty($customer)) {
            $result['message'] = "Account not exist";
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        $data = request()->toArray();
        $customer->update($data);

        $new_data = array_filter($customer->toArray(), function ($k, $v) {
            return in_array($v, ['full_name', 'email', 'address', 'shipping_address']);
        }, ARRAY_FILTER_USE_BOTH);
        $result['data'] = $new_data;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    function getOtp(Request $request)
    {
        $messages = [
            'phone.required'    => 'Số điện thoại thì không chính xác',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required|max:255'
            ],
            $messages
        );
        if ($validator->fails()) {
            return response()->json(['code' => 200, 'success' => false, 'error' => $validator->messages()], 200);
        }
        $date = date('Y-m-d H:i:s');
        $phone = request('phone');
        $check_otp = OTP::where("phone", $phone)->where("time_line", ">=", $date)->where("status","success")->first();
        if (!empty($check_otp)) {
            $result['code'] = 200;
            $result['success'] = true;
            $result['message'] = "Mã Otp đã được gửi tới Zalo, xin hãy kiểm tra tin nhắn";
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $zaloZns = new ZNS();
            $otp = $zaloZns->generateRandomString(6);

            //Handel update all otp old
            OTP::where("phone", $phone)->whereNull("status")->update(['status' => "expiration"]);
            $new_otp = OTP::updateOrCreate(['phone' => $phone, 'code' => $otp, 'time_line' => date('Y-m-d H:i:s', strtotime('+5 minutes'))]);
            // \App\Helpers\LogHelper::write($new_otp->toArray(),"CreateOTP");
            if (!empty($new_otp)) {
                $res = $zaloZns->sendOTP($phone, $otp);
                // \App\Helpers\LogHelper::write($res,"CreateOTP");
                if($res['code'] == 200)
                {
                    $new_otp->update(['status'=>'success','result'=>json_encode($res)]);
                }
                else{
                    throwException("Zalo ZNS error", url("zalodevelopers/otp"));
                    $new_otp->update(['status'=>'error','result'=>json_encode($res)]);
                }
            }

            // $zaloZns->sendOTP($phone, $otp);
            $result['code'] = 200;
            $result['success'] = true;
            return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
    function checkOTP()
    {
        $date = date('Y-m-d H:i:s');
        $otp = request('otp');
        $phoneNumber = request('phone');
        $otp = OTP::where('phone', $phoneNumber)->where('code', $otp)->where("status","success")->where("time_line", ">=", $date)->first();
        if (!empty($otp)) {
            $result['code'] = 200;
            $result['success'] = true;
        } else {
            $result['code'] = 200;
            $result['success'] = false;
            $result['message'] = 'Invalid OTP';
        }

        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function getProfile(Request $request)
    {
        $customer_id = auth('api')->user()->id;
        $result = Customer::where('id', $customer_id)->first();
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
