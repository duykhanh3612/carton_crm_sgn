<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Model\Page;
use Modules\Admin\Model\Contact;
use Validator;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getContact()
    {
        $query = new Page;
        $records = $query->where("slug", "contact")->first();
        if (isset($records->image)) {
            $records->image = url("public/" . $records->image);
        }
        $result['data'] =  $records->toArray();
        $result['code'] = 200;
        $result['success'] = true;
        if (method_exists($query, 'getOptions')) {
            $query->getOptions($result, $records);
        }
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    public function sendContact(Request $request)
    {
        $messages = [
            'name.required'  => 'Name is required',
            'phone.required'    => 'Phone is required',
            // 'email.required'    =>'Email is required',
            // 'message.required'    =>'Message is required',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                // 'email' => 'required|max:255',
                // 'message' => 'required',
            ],
            $messages
        );
        if ($validator->fails()) {
            return response()->json(['code' => 200, 'success' => false, 'error' => $validator->messages()], 200);
        }
        $data = [
            'name' => $request->name,
            'organization' => $request->organization,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ];
        $records = Contact::create($data);
        Mail::send('api::mail', ['data' => $data], function ($m) use ($data) {
            $email = "hailythanh@gmail.com";
            $name = request('name');
            $m->from($email,  $name)
                ->to($this->conf->site_mail,  $name)
                ->subject($data['mail_template']->name . ' từ ' . $email);
        });
        $result['data'] =  $records;
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function getIntro()
    {
        $query = new Page;


        $records = $query->where("slug", "intro")->first();
        if (isset($records->image)) {
            $records->image = url("public/" . $records->image);
        }
        $result['data'] =  $records->toArray();
        $result['code'] = 200;
        $result['success'] = true;
        if (method_exists($query, 'getOptions')) {
            $query->getOptions($result, $records);
        }
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('api::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('api::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function setting()
    {
        $records = \App\Model\base_model::find_all("settings")->pluck("hs_val", "hs_key");
        $records['logo'] = url("public/" . $records['logo']);
        $result['data'] =  $records->toArray();
        $result['code'] = 200;
        $result['success'] = true;
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
