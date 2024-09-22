<?php
namespace Modules\Admin\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class Ajax extends Base
{
    public function sort_nestable($table, $data, $id)
    {
        if (!is_array($data) || !$table || !$id) {
            return false;
        }
        return DB::table($table)->where('id', $id)->update($data);
    }

    public function changeValueWithField($table, $id, $field, $value, $only = 0)
    {
        $tableChild = getTableChild($table);
        try {
            if (is_array($id)) {
                DB::table($table)->whereIn('id', $id)->update([$field => $value]);
                if (!$only && !empty($tableChild)) DB::table($tableChild)->whereIn('cat', $id)->update([$field => $value]);
            } else {
                DB::table($table)->where('id', $id)->update([$field => $value]);
                if (!$only && !empty($tableChild)) DB::table($tableChild)->where('cat', $id)->update([$field => $value]);
            }
            return $id;
        } catch (\Throwable $e) {
            return $e;
        }
    }
    public function remove($table, $id, $only = 0)
    {
        try {
            DB::table($table)->where('id', $id)->delete();
            $tableChild = getTableChild($table);
            if(!empty($tableChild)) {
                $infoChild = get_data($tableChild, 'category = "' . $id . '"', '**');
                $ids = array_column($infoChild, 'id');
                if(!$only && !empty($infoChild)) DB::table($tableChild)->whereIn('id', $ids)->update(['cat' => 0, 'deleted' => 1]);
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function delete_dir($nameField)
    {
        $dirPath = UPLDIR . $nameField;
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}
