<?php

namespace Modules\ZaloDevelopers\Model;

class Template extends Base
{
    protected $table = 'zalo_zns_template';
    protected $primaryKey = 'templateId';
    protected $guarded = [];
    protected $endpoint = "template/all";
}
