<?php

namespace  App\Services\Google;

use PhpParser\Builder\Class_;

class Map
{
    public function __construct(array $options = [])
    {
    }
    public static function getDirection($from, $to)
    {
        return (new self())->get_direction($from,$to);
    }
    function get_direction($from, $to)
    {
        if($from == "" || $to == "")
        {
            return "";
        }
        $from = urlencode($from);
        $to = urlencode($to);
        $api = "https://maps.googleapis.com/maps/api/directions/json?origin=$from&destination=$to&key=AIzaSyCBETz6vreNaK1VP8MFwCXiQ8snEJPUcwc";
        $res = json_decode(file_get_contents($api),true);
        $name = "routes.0.legs.0.steps.0.html_instructions";
        $html_instructions = \Arr::get($res, $name);
        $direction = $this->everything_in_tags($html_instructions,'b');
        return $this->convert_direction($direction);
    }
    function everything_in_tags($string, $tagname)
    {
        $pattern = "#<\s*?$tagname\b[^>]*>(.*?)</$tagname\b[^>]*>#s";
        preg_match($pattern, $string, $matches);
        return $matches[1];
    }

    function convert_direction($string)
    {
        $direction ="";
        switch(strtolower($string)){
            case 'east':
            case 'đông':
            case 'hướng đông':
                $direction = 'east';
                break;
            case 'west':
            case 'tây':
            case 'hướng tây':
                $direction = 'west';
                break;
            case 'southwest':
            case 'tây nam':
                $direction = 'southwest';
                break;
            case 'south':
            case 'nam':
            case 'hướng nam':
                $direction = 'south';
                break;
            case 'north':
            case 'bắc':
            case 'hướng bắc':
                $direction = 'north';
                break;
            default:
                $direction = "";
                break;
        }
        return $direction;
    }
}