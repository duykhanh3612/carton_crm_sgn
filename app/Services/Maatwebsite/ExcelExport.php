<?php


namespace App\Services\Maatwebsite;

use GuzzleHttp\Client as GuzzleHttpClient;
use App\Helpers\LogHelper;

use Maatwebsite\Excel\Facades\Excel;

class ExcelExport
{
    function view($path, $data = [], $filename, $disk = "")
    {
        if($disk != "")
        {
            return Excel::store(new ExportFromView($path, $data), $filename,$disk );
        }
        return Excel::download(new ExportFromView($path, $data), $filename );
    }
}
