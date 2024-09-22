<?php


namespace App\Helpers;


class CsvHelper
{
    const FILE_EXT_ERROR_MESSAGE = 'Invalid File Extension.';
    const READ_FILE_ERROR_MESSAGE = 'Can not read file.';

    /**
     * Format extension of file to compare
     *
     * @param string $fileName File name/path
     *
     * @return string Formatted Extension;
     */
    public static function formatExtension($fileName = null)
    {
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
    public static function validateFileExtension($fileName = null, $acceptedList = array('txt', 'csv'))
    {
        if (empty($acceptedList)) {
            return false;
        }
        $acceptedList = array_map('strtoupper' , $acceptedList);
        $ext = self::formatExtension($fileName);
        return in_array($ext, $acceptedList);
    }

    public static function readToArray($fileName = null, $firstRowHeader = false)
    {
        $validated = self::validateFileExtension($fileName);
        if ($validated) {
            return self::readFile($fileName, $firstRowHeader);
        } else {
            return self::FILE_EXT_ERROR_MESSAGE;
        }
    }

    public static function readFile($fileName = null, $firstRowHeader = false)
    {
        if (!file_exists($fileName)) {
            return 0;
        }
        try {
            $header = NULL;
            $data = array();
            $delimiter = static::detectDelimiter($fileName);
            if (($handle = fopen($fileName, 'r')) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                    if ($firstRowHeader) {
                        if (!$header) {
                            $header = $row;
                            $header = array_map('trim', $header);
                        } else {
                            $data[] = array_combine($header, $row);
                        }
                    } else {
                        $data = $row;
                    }

                }
                fclose($handle);
            }
            return $data;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public static function detectDelimiter($fileName)
    {
        if ($fileName && file_exists($fileName)) {
            $delimiters = [";" => 0, "," => 0, "\t" => 0, "|" => 0];
            $handle = fopen($fileName, "r");
            $firstLine = fgets($handle);
            fclose($handle);
            foreach ($delimiters as $delimiter => &$count) {
                $count = count(str_getcsv($firstLine, $delimiter));
            }
            return array_search(max($delimiters), $delimiters);
        }
        return ',';
    }

    public static function writeCsv($data = [] , $filePath = 'csv_helper.csv' , $delimiter = ','){
        $handle = fopen($filePath, 'w+');
        if ($handle) {
            foreach ($data as $line) {
                fputcsv($handle, $line , $delimiter);
            }
            return 1;
        }
        return 0;
    }
}
