<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Validation\Rules\Exists;

class ModuleFunction extends Model
{
    protected $table = 'modules_function';
    protected $guarded = [];
    protected $owner = "customers.created_by";
}
