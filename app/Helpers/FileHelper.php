<?php

namespace App\Helpers;

use Maatwebsite\Excel\Facades\Excel;

class FileHelper
{
    const FILE_EXT_CONFIG = 'constants.common.file_extension';
    const FILE_EXT_ERROR_MESSAGE = 'Invalid File Extension.';
    const READ_FILE_ERROR_MESSAGE = 'Can not read file.';
    /**
     * Format extension of file to compare
     *
     * @param string $fileName File name/path
     *
     * @return string Formatted Extension;
     */
    public static function formatExtension($fileName = null) {
        return strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
    }
    
    /**
     * Validate file type
     *
     * @param string $fileName
     * @param array $acceptedList List available on config.constants.common.file_extension
     *
     * @return status(boolean) 
     */
    public static function validateFileExtension($fileName = null, $acceptedList = array('excel', 'csv')) {
        $acceptedExtList = array();
        $extConfig       = config(self::FILE_EXT_CONFIG);
        if (empty($acceptedList)) {
            return false;
        }
        foreach ($acceptedList as $type) {
            if (!empty($extConfig[$type])) {
                $acceptedExtList = array_merge($acceptedExtList, $extConfig[ $type ]);
            }
        }
        $ext = self::formatExtension($fileName);
        return in_array($ext, $acceptedExtList);
    }
    
    public static function readToArray($fileName = null, $model = null, $firstRowHeader = false){
        $validated = self::validateFileExtension($fileName);
        if($validated){
            return self::readFile($fileName, $model, $firstRowHeader);
        }else{
            return self::FILE_EXT_ERROR_MESSAGE;
        }
    }
    
    public static function readFile($fileName =  null, $model = null, $firstRowHeader = false){
        try{
            $lines = Excel::toArray($model, $fileName);
            if(!$firstRowHeader){
                return $lines;
            }
            $data = array_shift($lines);
            $data = array_filter($data);
            $headers = array_shift($data);
            $headers = array_map('strtolower', $headers);
            $headers = array_map('trim', $headers);
            if($headers){
                $data = array_map(function($v)use($headers){
                    return array_combine($headers, $v);
                }, $data);
            }
            return $data;
        }catch(\Throwable $e){
            return 0;
        }
    }
}
