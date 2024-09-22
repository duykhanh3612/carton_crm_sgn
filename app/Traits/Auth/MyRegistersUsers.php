<?php

namespace App\Traits\Auth;

use App\Helpers\SendMailHelper;
use App\Models\Hyperspace\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait MyRegistersUsers
{
    use RegistersUsers;

    public function showRegistrationForm() {
        return view($this->_registerView,
            array(
                'prefix'    => $this->_prefix,
                'pageTitle' => $this->_pageTitle
            )
        );
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $view = "admin.send_mail";
        $subject = env('MAIL_SUBJECT_RESISTRATION', 'Hyperspace Registration');
        SendMailHelper::sendMail($view, $user->toArray(), $subject);

        return redirect($this->redirectPath());
    }

    /**
     * Create new user
     *
     * @param array $params Request params
     *
     * @return User
     */
    public function create($params) {
        $record = $this->_model;
        $record->fill($params);
        $record->client_id = !empty($params['client_id']) ? $params['client_id'] : $this->_model->getIncrementClientId();
        $record->password  = Hash::make($params['password']);

        $record->save();

        return $record;
    }

    /**
     * Validate request
     *
     * @param array $params Request params
     *
     * @return Validator
     */
    public function validator($params) {
        $validator = $this->_model->storeRule($params);

        return $validator;
    }
}
