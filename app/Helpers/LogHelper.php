<?php

namespace App\Helpers;

class LogHelper
{
    public static function write($data = null, $key = null, $clientId = 0) {
        if(!$clientId && !empty(auth()->user()->id)){
            $clientId = auth()->user()->id;
        }
        if(!$clientId){
            $clientId = 'global';
        }
        $file = __DIR__.'/../../storage/logs/'.date('Y-m-d').'-client-'.$clientId.'.log';
        $prefix = 'PID'.getmypid().':DATE:'.gmdate("Y-m-d\TH:i:s\Z");
        if($key){
            $prefix .= ':'. $key;
        }
        if(is_object($data) && ($data instanceof \Error || $data instanceof \Exception || $data instanceof \Throwable)) {
            $data = 'EXCEPTION:'. $data->getCode(). ':' .$data->getMessage();
        }
        $method = '';
        $backtraces = debug_backtrace (DEBUG_BACKTRACE_IGNORE_ARGS, 5);
        if($backtraces && is_array($backtraces)){
            foreach($backtraces as $key => $backtrace){
                $class = @$backtrace['class'];
                $function = @$backtrace['function'];
                if(strpos($class, 'App\Models\ClientLog') === false && strpos($class, 'App\Helpers\LogHelper') === false){
                    $method .= $class . '->' . $function;
                    $lineKey = $key - 1;
                    $line = @$backtraces[$lineKey]['line'];
                    if($line){
                        $method .= '->' .$line;
                    }
                    $method .= ' ';
                }
            }
        }
        if(!is_string($data)){
            if(!is_array($data)){
                try{
                    $data = var_export($data, true);
                }catch(\Throwable $e){
                    $data = var_export($e);
                }
            }
            $data = json_encode($data);
        }
        $logString = $prefix . ':METHOD: ' . $method. "\n";
        $logString .= $prefix . ':DATA: ' . $data. "\n\n";
        $fn = fopen($file, 'a');
        fwrite($fn, $logString);
        fclose($fn);
    }

    public static function memoryUsage($key = null, $clientId = 0) {
        if(!$clientId && !empty(auth()->user()->client_id)){
            $clientId = auth()->user()->client_id;
        }
        if(!$clientId){
            $clientId = 'global';
        }
        $file = __DIR__.'/../../storage/logs/'.date('Y-m-d').'-client-'.$clientId.'memoryUsage.log';
        $prefix = 'PID'.getmypid().':DATE:'.gmdate("Y-m-d\TH:i:s\Z");
        if($key){
            $prefix .= ':'. $key;
        }
        $method = '';
        $backtraces = debug_backtrace (DEBUG_BACKTRACE_IGNORE_ARGS, 5);
        if($backtraces && is_array($backtraces)){
            foreach($backtraces as $key => $backtrace){
                $class = @$backtrace['class'];
                $function = @$backtrace['function'];
                if(strpos($class, 'App\Models\ClientLog') === false && strpos($class, 'App\Helpers\LogHelper') === false){
                    $method .= $class . '->' . $function;
                    $lineKey = $key - 1;
                    $line = @$backtraces[$lineKey]['line'];
                    if($line){
                        $method .= '->' .$line;
                    }
                    $method .= ' ';
                }
            }
        }
        $data = 'memory_get_usage:'.memory_get_usage().'memory_get_peak_usage:'.memory_get_peak_usage();
        $logString = $prefix . ':METHOD: ' . $method. "\n";
        $logString .= $prefix . ':DATA: ' . $data. "\n\n";
        $fn = fopen($file, 'a');
        fwrite($fn, $logString);
        fclose($fn);
    }
}
