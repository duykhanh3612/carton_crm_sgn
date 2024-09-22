<?php

namespace Modules\ZaloDevelopers\Model;

use App\Services\Zalo\ZNS;
class TemplateInfo extends Base
{
    protected $table = 'zalo_zns_template';
    protected $primaryKey = 'templateId';
    protected $guarded = [];
    protected $endpoint = "template/info";
    protected $query_paras = ['template_id'=>'templateId'];

    public function tranformData($item)
    {
        $item['listParams'] = json_encode( $item['listParams'] );
        return $item;
    }

    public function send($id, $item)
    {
        $zns = new ZNS(['template_id'=>$id,'template_data'=>array_keys($item)]);
        $zns->send($item);
    }
}
