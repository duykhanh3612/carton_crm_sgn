<?php

namespace App\Helpers;

use App\Models\Hyperspace\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UtilHelper
{
    /**
     * Get guard type of current user
     *
     * @return mixed|string Guard of current user
     */
    public static function getGuardName() {
        $guards = config('constants.guard');

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        return '';
    }

    public static function getIncrementIdByCollection($collection, $field) {
        $record = DB::table($collection)->max($field);

        if ($record) {
            return $record + 1;
        }

        return 1;
    }

    public static function parseCustomFieldToGridType($custom) {
        $parse = array();

        if (!empty($custom)) {
            foreach ($custom as $key => $value) {
                $parse[ 'item_custom@' . $key ] = $value;
            }
        }

        return $parse;
    }

    public static function checkUpdateDimension($old, $new, $dimensions) {
        $hasDiff = false;

        if (!empty($dimensions)) {
            foreach ($dimensions as $dimension) {
                if (!empty($dimension['customFieldId'])) {
                    $hasDiff = @$old['custom'][ $dimension['spField'] ] != @$new['custom'][ $dimension['spField'] ] ? true : false;
                } else {
                    $hasDiff = @$old[ $dimension['spField'] ] != @$new[ $dimension['spField'] ] ? true : false;
                }

                if ($hasDiff) {
                    break;
                }
            }
        }

        return $hasDiff;
    }
}
