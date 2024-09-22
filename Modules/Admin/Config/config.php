<?php

$arr =  [
    'name' => 'Phần mềm quản lý bán hàng',
    'theme' => [
        "default" => [
            'path'  => "admin"
        ],
        "carton" => [
            'path'  => "themes/admin/carton"
        ]
    ]
];

$files = scandir(dirname(__FILE__));

foreach($files as $file)
{
    if(!in_array($file,['.','..','.gitkeep','config.php', 'config_define.php']))
    {
	$data = include $file;
	$arr = array_merge($arr,$data);
    }
}
include("config_define.php");
return $arr;
