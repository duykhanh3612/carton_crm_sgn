<?php

namespace App\Model\Traits;

use Illuminate\Support\Facades\DB;

trait Command
{
    public static function query_cmd($cmd)
    {
        return DB::statement($cmd);
    }
    public static function query_select($cmd)
    {
        return DB::select($cmd);
    }
    public static function record_count()
    {
        if (config('database.default') == "sqlite") {
            $tables = self::query_table_name('');
            $cmd = "";
            foreach($tables as $table)
            {
                if(!\Str::startsWith($table->name, "_"))
                {
                    $cmd .= "SELECT '$table->name' AS table_name, COUNT(*) AS count FROM $table->name UNION ";
                }

            }
            $cmd = substr($cmd,0,strlen($cmd)-7);
            $records = collect(\md::query_select($cmd))->keyBy('table_name');
            return $records;
        }
        else{
            $table_row_count = \md::pro("get_record_tables");
            $cmd  = "";
            foreach($table_row_count as $r)
            {
                $cmd .= current($r);
            }
            $cmd = substr($cmd,0,strlen($cmd)-7);

            $records = collect(\md::query_select($cmd))->keyBy('table_name');
            return $records;
        }
    }
    public static function query_table_name($pre = '')
    {
        if (config('database.default') == "sqlite") {
            return  DB::select("SELECT name FROM sqlite_master WHERE type ='table' AND name NOT LIKE 'sqlite_%'");
        } else {
            if($pre == '') $pre = env("DB_DATABASE");
            return DB::select("SELECT TABLE_NAME as name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' and TABLE_SCHEMA like '" . $pre . "'");
        }
    }
    public static function query_fields($pre = '')
    {
        if (config('database.default') == "sqlite") {
            return DB::select("PRAGMA table_info('$pre')");
        } else {
            return DB::select("SELECT TABLE_NAME as name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' and TABLE_SCHEMA like '" . $pre . "'");
        }
    }
    public static function query_field_name($table = '')
    {
        if (config('database.default') == "sqlite") {
            return DB::select("SELECT name FROM PRAGMA_TABLE_INFO('$table')");
        } else {
            return DB::select("SELECT `COLUMN_NAME` as `name`,`COLUMN_COMMENT` as 'comment',`DATA_TYPE` as 'type' FROM `INFORMATION_SCHEMA`.`COLUMNS`  WHERE  `TABLE_NAME`='$table' GROUP BY COLUMN_NAME,COLUMN_COMMENT,DATA_TYPE");
        }
    }
    public static function query_field_name_comment($table = '')
    {
        return DB::select("SELECT `COLUMN_NAME` as `name`,`COLUMN_COMMENT` as `comment` FROM `INFORMATION_SCHEMA`.`COLUMNS`  WHERE  `TABLE_NAME`='$table' and  COLUMN_COMMENT<>''");
    }

    public static function queryRowCount($dbName)
    {
        $cmd  = "SELECT CONCAT('SELECT \"',table_name,'\" AS table_name, COUNT(*) AS exact_row_count FROM ',table_schema,'.',table_name,' UNION ') as cmd FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '$dbName'";
        $commands =  DB::select($cmd);

        $result = "";
        foreach ($commands as $key => $command) {
            $result .=  $command->cmd;
        }
        $result = rtrim($result);
        if (\Str::endsWith(rtrim($result), 'UNION')) {
            $result =  substr($result, 0, strlen($result) - 6);
        }

        $rows =  DB::select($result);
        return $rows;
    }
}
