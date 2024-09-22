<?php


namespace App\Services\Phone;

use GuzzleHttp\Client as GuzzleHttpClient;
use App\Helpers\LogHelper;

class Carrier
{

    protected $carriers_number = [
        '086' => 'VIETTEL',
        '096' => 'VIETTEL',
        '097' => 'VIETTEL',
        '098' => 'VIETTEL',
        '032' => 'VIETTEL',
        '033' => 'VIETTEL',
        '034' => 'VIETTEL',
        '035' => 'VIETTEL',
        '036' => 'VIETTEL',
        '037' => 'VIETTEL',
        '038' => 'VIETTEL',
        '039' => 'VIETTEL',

        //Mobifone
        '090' => 'VMS',
        '093' => 'VMS',
        '070' => 'VMS',
        // '071' => 'Mobifone',
        // '072' => 'Mobifone',
        '076' => 'VMS',
        '077' => 'VMS',
        '078' => 'VMS',
        '079' => 'VMS',
        '089' => 'VMS',

        //Vinaphone
        '091' => 'GPC',
        '094' => 'GPC',
        '083' => 'GPC',
        '084' => 'GPC',
        '085' => 'GPC',
        '081' => 'GPC',
        '082' => 'GPC',
        '088' => 'GPC',

        '099' => 'Gmobile',

//Vietnamobile
        '092' => 'VNM',
        '056' => 'VNM',
        '058' => 'VNM',

        '095'  => 'SFone'
    ];

    function getProvider( $phone )
    {
        return $this->detect_number($phone);
    }
    /**
     * Detect carrier name by phone number
     *
     * @param string $number The input phone number
     * @return bool Name of the carrier, false if not found
     */
    function detect_number ($number) {
        $number = str_replace(array('-', '.', ' '), '', $number);

        // Store all start number in an array to search
        $start_numbers = array_keys($this->carriers_number);
        foreach ($start_numbers as $start_number) {
            // if $start number found in $number then return value of $carriers_number array as carrier name
            if ($this->start_with($start_number, $number)) {
                return $this->carriers_number[$start_number];
            }
        }
        // if not found, return false
        return false;
    }

    /**
     * Check if a string is started with another string
     *
     * @param string $needle The string being searched for.
     * @param string $haystack The string being searched
     * @return bool true if $haystack is started with $needle
     */
    function start_with($needle, $haystack) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}
