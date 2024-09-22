<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ImportHelper
{
    /**
     * Format extension of file to compare
     *
     * @param string $file File path
     *
     * @return string Formatted Extension;
     */
    public static function formatExtension($file) {
        return strtoupper(pathinfo($file, PATHINFO_EXTENSION));
    }

    /**
     * Validate file type
     *
     * @param string $fileIndex Key index of file on $_FILE
     * @param array $acceptedList List available on config.constants.common.file_extension
     *
     * @return array status(boolean) - message(string)
     */
    public static function validateFileExtension($fileIndex, $acceptedList = array('excel', 'csv')) {
        $result = array(
            'status'  => true,
            'message' => ''
        );

        $importLang = Lang::get('import');
        if (empty($_FILES[ $fileIndex ])) {
            $result['status']  = false;
            $result['message'] = $importLang['empty_file'];

            return $result;
        }

        $acceptedExList = array();
        $exConfig       = Config::get('constants.common.file_extension');

        if (empty($acceptedList)) {
            return $result;
        }

        foreach ($acceptedList as $type) {
            if (!empty($exConfig[ $type ])) {
                $acceptedExList = array_merge($acceptedExList, $exConfig[ $type ]);
            }
        }

        $extension = self::formatExtension($_FILES[ $fileIndex ]['name']);

        $valid = in_array($extension, $acceptedExList);

        if (!$valid) {
            $result['status']  = false;
            $result['message'] = $importLang['ex_not_allow'];
        }

        return $result;
    }

    /**
     * Move upload file to new folder
     *
     * @param string $filePath Path of old file
     * @param string $desFolder Destination folder 'config/filesystems.php:disks.$disk.root'
     * @param string $oldName Original name
     * @param string $newName New name instead of original name
     * @param string $disk Choose the disk to store
     * @param boolean $move Force move file
     *
     * @return string Full new path
     */
    public static function moveFileUpload($filePath, $desFolder = '', $oldName = '', $newName = '', $disk = '', $move = false) {
        $fileName  = date('Ymdhis') . '_' . $oldName;
        $desFolder = str_replace('\\', '/', $desFolder);

        if (!empty($newName)) {
            $fileName = $newName;
        }

        $desPath = Storage::disk($disk)->putFileAs(
            $desFolder, new File($filePath), $fileName
        );

        if ($desPath === false) {
            return '';
        }

        if ($move) {
            unlink($filePath);
        }

        return $desPath;
    }
}
