<?php 
namespace App\Helpers;

class DateHelper
{
    public static function getServerTimeOffset($timezone = 'UTC') {
        $currentTz = date_default_timezone_get();
        $current = timezone_open($timezone);
        $serverTime  = new \DateTime('now', new \DateTimeZone($currentTz));
        $offset =  timezone_offset_get( $current, $serverTime);
        return $offset;
    }
    
    public static function convertToServerHour($timezone = 'UTC', $hour = '00:00'){
        $offset = self::getServerTimeOffset($timezone);
        $minute = '00';
        if(is_string($hour)){
            $hourMinute = ltrim($hour, '0');
            $hour = explode(':', $hourMinute)[0];
            $minute = explode(':', $hourMinute)[1];
            $minute = substr($minute, 0, 2);
            if(!$minute){
                $minute = '00';
            }
        }
        $hour = (int) $hour;
        if(!$hour) $hour = 24;
        $hour = $hour*3600;
        $serverHour = $hour - $offset;
        $serverHour = $serverHour/3600;
        if($serverHour > 23){
            $serverHour = $serverHour - 24;
        }
        if($serverHour < 0){
            $serverHour = $serverHour + 24;
        }
        return $serverHour.':'.$minute;
    }
}