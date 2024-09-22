<?php

namespace App\Helpers;

use App\Models\Hyperspace\UserSetting;

class SettingHelper
{
    public static function getAll($clientId = 0) {
        if($clientId && !empty(auth()->user()->client_id) && $clientId != auth()->user()->client_id){
            UserSetting::switchToClientDatabase($clientId);
        }
        return UserSetting::getAllSettings();
    }
    
    public static function getOne($key = '', $clientId = 0) {
        if($clientId && !empty(auth()->user()->client_id) && $clientId != auth()->user()->client_id){
            UserSetting::switchToClientDatabase($clientId);
        }
        $setting = UserSetting::where(UserSetting::HS_KEY, $key)->first();
        if($setting){
            return $setting[UserSetting::HS_VAL];
        }
        return $setting;
    }
}
