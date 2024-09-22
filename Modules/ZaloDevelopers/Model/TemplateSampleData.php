<?php

namespace Modules\ZaloDevelopers\Model;

use App\Services\Zalo\ZNS;

class TemplateSampleData extends Base
{
    protected $table = 'zalo_zns_template';
    protected $primaryKey = 'templateId';
    protected $guarded = [];
    protected $endpoint = "template/sample-data";
    protected $query_paras = ['template_id'=>'templateId'];
    protected $save_as_json = true;
    protected $save_as_field = "sample_data";

    // public function tranformData($item)
    // {
    //     $item['templateId'] =  (new self())->templateId;
    //     return $item;
    // }

    public function send($id, $item)
    {
        $zns = new ZNS(['template_id'=>$id,'template_data'=>array_keys($item)]);
        $zns->send($item);
    }
}
