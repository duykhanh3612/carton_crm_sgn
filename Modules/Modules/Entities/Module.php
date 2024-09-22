<?php

namespace Modules\Modules\Entities;

class Module
{
    protected static $location = "";
    protected static $nodes = [];
    protected static $cdn = false;
    public static function instance() {
        return new Module();
    }

    public function __construct($option = [])
    {


    }
    public function module_fields($table, $detail = false)
    {
        if ($detail) {
            $table = $table . '_details';
        }

        $theads = [];
        if(!empty(config("admin.".$table. '.theads'))){
            $theads = array_filter(config("admin.".$table. '.theads'), function ($value) {
                if ((!isset($value['viewable']) || \Arr::get($value, 'viewable')) && !in_array( $value['field'],["action",""]) ) {
                    return $value;
                }
            });
            $theads = collect($theads)->pluck('field')->toArray();
        }

        if (Schema::hasTable($table)) {
            $cols = array();
            // $query = 'SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env("DB_DATABASE") . '" AND TABLE_NAME = "' . $table . '"';
            $query = 'SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "' . $table . '"';
            $fields = DB::select($query);
            $fields = json_decode(json_encode($fields), true);
            foreach ($fields as $field) {
                $cols[$field['COLUMN_NAME']] = (object) array(
                    'show' => in_array( $field['COLUMN_NAME'],$theads),
                    'name' => $field['COLUMN_COMMENT']!=""?$field['COLUMN_COMMENT']: ucfirst($field['COLUMN_NAME']),
                    'type' => "",
                    'filter' => "",
                    'detail' => $detail
                );
            }
            return (object) $cols;
        } else {
            return false;
        }
    }
}
