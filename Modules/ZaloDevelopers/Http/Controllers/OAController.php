<?php

namespace Modules\ZaloDevelopers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ZaloDevelopers\Model\OA;
use Modules\ZaloDevelopers\Model\OTP;
use Modules\ZaloDevelopers\Model\Template;
use Modules\Plugin\Entities\Themes;
use App\Model\base_model;
use App\Services\Zalo\ZNS;
class OAController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['items'] = OA::paginate(15);
        return Themes::render('zalodevelopers::oa.index', $data);
    }
    public function otp()
    {
        $items = OTP::search(['keywords' => request('keywords'),'filter'=>request('filter')])
            ->orderBy("time_line","desc")->paginate(15);

        $items->appends(request()->all());

        $data['items'] = $items;
        return Themes::view('zalodevelopers::oa.otp', $data);
    }

    function otp_resend($id)
    {
        $otp = OTP::where("id",$id)->first();
        $zaloZns = new ZNS();

        //Handel update all otp old
        OTP::where("phone", $otp->phone)->whereNull("status")->update(['status' => "expiration"]);
        $new_otp = $otp->update(['time_line' => date('Y-m-d H:i:s', strtotime('+5 minutes'))]);

        $zaloZns->sendOTP($otp->phone, $otp->code);

        return redirect()->back();
    }
    function otp_destroy($id = null)
    {
        base_model::remove("otp", $id);
        return redirect()->back();
    }
    function download($id)
    {
        $item = OA::find($id);
        if (!empty($item)) {
            $item->download([], ['access_token' => $item->access_token, 'id' => $item->id]);
        }
        return redirect()->back()->withSuccess('Download OA Info successfully!');
    }
    function downloadZNS($id)
    {
        $item = OA::where('id', $id)->first();
        $fields =  ['access_token' => $item->access_token, 'fill' => ['oa'=>$item->name]];
        (new Template())->download([], $fields);
        return redirect()->back()->withSuccess('Download OA Info successfully!');
    }
}
