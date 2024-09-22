<?php

namespace App\Model;

use Cache;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use LogHelper;
use Throwable;
use App\Model\Traits\Command;

class base_model extends Model
{
    use Command;
    static $prefix = '';
    static $field_id = 'id';

    public static function find_json($table_name)
    {
        return \h::getStore($table_name);
    }
    /**
     * Summary of select

     * @param mixed $table_name
     * @param mixed $conditions
     * @param mixed $orderby

     * @return mixed
     */
    public static function select_join($table_name = null, $conditions = null, $orderby = null, $join = null, $select = null, $group = null)
    {
        $value = DB::table($table_name);
        if ($join != null) {
            $join = is_string($join) ? json_decode($join, true) : $join;
            if (\h::is_multi($join)) {
                foreach ($join as $join_table) {
                    switch (@$join_table['join']) {
                        case 'left':
                            $value->leftJoin($join_table['table'], $table_name . '.' . $join_table['field'], '=', $join_table['table'] . '.' . $join_table['key']);
                            break;
                        case 'right':
                            $value->rightJoin($join_table['table'], $table_name . '.' . $join_table['field'], '=', $join_table['table'] . '.' . $join_table['key']);
                            break;
                        case 'innerjoin_third':
                            $value->join($join_table['table'], $join_table['field'], '=', $join_table['table'] . '.' . $join_table['key']);
                            break;
                        default:
                            $value->join($join_table['table'], $table_name . '.' . $join_table['field'], '=', $join_table['table'] . '.' . $join_table['key']);
                            break;
                    }
                }
            } else {
                switch (@$join['join']) {
                    case 'left':
                        $value->leftJoin($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                        break;
                    case 'right':
                        $value->rightJoin($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                        break;
                    default:
                        $value->join($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                        break;
                }
            }
        }
        if ($select != null) {
            $value->selectRaw($select);
        }

        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }

        if ($group != null) {
            $value->groupBy(DB::raw($group));
        }

        return $value->get();
        // return DB::table($table_name)->whereRaw($conditions)->get();
    }
    /**
     * Summary of select
     *
     * @param  mixed $table_name
     * @param  mixed $conditions
     * @param  mixed $orderby
     * @return mixed
     */
    public static function select($table_name = null, $conditions = null, $orderby = null)
    {
        $value = DB::table($table_name);
        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }

        return $value->get();
        // return DB::table($table_name)->whereRaw($conditions)->get();
    }
    /**
     * Summary of select
     *
     * @param  mixed $table_name
     * @param  mixed $conditions
     * @param  mixed $orderby
     * @return mixed
     */
    public static function select_limit($table_name = null, $select = null, $conditions = null, $orderby = null, $star = null, $limit = null)
    {
        $value = DB::table($table_name);
        if ($select != null) {
            $value->selectRaw($select);
        }

        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }

        if (intval($star) != 0) {
            $value->skip($star);
        }

        if ($limit != null) {
            $value->take($limit);
        }

        //if($group!=NULL)
        //    $value->groupBy($group);
        return $value->get();
        // return DB::table($table_name)->whereRaw($conditions)->get();
    }
    /**
     * Summary of select
     *
     * @param  mixed $table_name
     * @param  mixed $conditions
     * @param  mixed $orderby
     * @return mixed
     */
    public static function select_query($table_name = null, $select = null, $conditions = null, $orderby = null)
    {
        $value = DB::table($table_name);
        if ($select != null) {
            $value->selectRaw($select);
        }

        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }
        return $value->get();
        // return DB::table($table_name)->whereRaw($conditions)->get();
    }
    /**
     * Summary of find_query
     *
     * @param  mixed $table_name
     * @param  mixed $conditions
     * @param  mixed $select
     * @param  mixed $orderby
     * @param  mixed $flg
     * @return mixed
     */
    public static function find_query($table_name = null, $conditions = null, $select = null, $orderby = null, $flg = false)
    {
        $value = DB::table($table_name);
        if ($select != null) {
            $value->selectRaw($select);
        }

        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }

        if ($flg == true) {
            return $value->first()->toArray();
        } else {
            return $value->first();
        }
    }
    /**
     * Return Array
     *
     * @param  mixed $table_name Table name
     * @param  mixed $conditions <IF>
     * @param  mixed $orderby    <Order>
     * @return array Array
     */
    public static function find($table_name = null, $conditions = null, $orderby = null, $select = null)
    {
        if (Schema::hasTable($table_name)) {
            $value = DB::table($table_name);
            if ($select != null) {
                $value->selectRaw($select);
            }
            switch (config('database.default')) {
                case "mongodb":

                    if ($conditions != null) {
                        self::applyCondition($value, $conditions);
                    }
                    if ($orderby != null) {
                        //  $value->orderByRaw($orderby); todo
                    }

                    break;
                default:
                    if ($conditions != null) {
                        $value->whereRaw($conditions);
                    }
                    if ($orderby != null) {
                        $value->orderByRaw($orderby);
                    }
                    break;
            }
            return $value->first();
        } else {
            return (object)[];
        }
    }
    public static function pre_find($table_name = null, $conditions = null, $flg = false)
    {
        if (Schema::hasTable($table_name)) {
            $value = DB::table(self::$prefix . $table_name);
            if ($conditions != null) {
                $value->whereRaw($conditions);
            }

            if ($flg == true) {
                return (array) $value->first();
            } else {
                return $value->first();
            }
        } else {
            return null;
        }
    }
    public static function count($table_name = null, $conditions = null)
    {
        try {
            $value = DB::table($table_name);
            if ($conditions != null) {
                $value->whereRaw($conditions);
            }

            return $value->count();
        } catch (Exception $exception) {
            return 0;
        }
    }
    /**
     * Summary of find_all
     *
     * @param  mixed $table_nam  Tên
     *                           table
     * @param  mixed $conditions [Điều kiện]
     * @param  mixed $orderby    [Order by]
     * @param  mixed $star       [Start record]
     * @param  mixed $limit      [Limit record]
     * @return array
     */
    public static function find_all($table_name = null, $conditions = null, $orderby = null, $star = null, $limit = null, $is_array = null, $keyBy = null)
    {
        $value = DB::table($table_name);
        switch (config('database.default')) {
            case "mongodb":
                if ($conditions != null) {
                    self::applyCondition($value, $conditions);
                }
                if ($orderby != null) {
                    //  $value->orderByRaw($orderby); todo
                }
                break;
            default:
                if ($conditions != null) {
                    $value->whereRaw($conditions);
                }

                if ($orderby != null) {
                    $value->orderByRaw($orderby);
                }

                if (intval($star) != 0) {
                    $value->skip($star);
                }

                if ($limit != null) {
                    $value->take($limit);
                }
                break;
        }
        if ($is_array != null) {
            return array_map(
                function ($v) {
                    return (array) $v;
                },
                $value->get()->toArray()
            );
        } else {
            if ($keyBy != null) {
                return $value->get()->keyBy($keyBy);
            }
            return $value->get();
        }
    }
    public static function find_all_query($table_name = null, $conditions = null, $select = null, $orderby = null, $flg = false)
    {
        $value = DB::table($table_name);
        if ($select != null) {
            $value->selectRaw($select);
        }

        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }

        if ($flg == true) {
            return $value->get()->toArray();
        } else {
            return $value->get();
        }
    }
    public static function find_all_slug($table_name = null, $slug = null, $conditions = null, $orderby = null)
    {
        $value = DB::table($table_name);
        $value->join(
            'sys_slugs',
            function ($join) use ($table_name, $slug) {
                $join->on("reference_id", '=', $table_name . '.id')->where('sys_slugs.reference_type', '=', $slug);
            }
        );

        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }
        if (config('database.default') == "sqlite") {
            $value->selectRaw($table_name . ".*,('" . url('') . "/' || sys_slugs.key) as url");
        } else {
            $value->selectRaw($table_name . ".*,CONCAT('" . url('') . "/',sys_slugs.key) as url");
        }

        return $value->get();
    }
    // region Paging
    public static function paging($table_name = null, $conditions = null, $orderby = null, $limit = null, $join = null, $select = null)
    {
        $value = DB::table($table_name);
        if ($join != null) {
            $join = json_decode($join, true);

            if (\h::is_multi($join)) {
                foreach ($join as $join_table) {
                    switch ($join_table['join']) {
                        case 'left':
                            $value->leftJoin($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                            break;
                        case 'right':
                            $value->rightJoin($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                            break;
                        case 'innerjoin_third':
                            $value->join($join_table['table'], $join_table['field'], '=', $join_table['table'] . '.' . $join_table['key']);
                            break;
                        default:
                            $value->join($join_table['table'], $table_name . '.' . $join_table['field'], '=', $join_table['table'] . '.' . $join_table['key']);
                            break;
                    }
                }
            } else {
                switch ($join['join']) {
                    case 'left':
                        $value->leftJoin($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                        break;
                    case 'right':
                        $value->rightJoin($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                        break;
                    default:
                        $value->join($join['table'], $table_name . '.' . $join['field'], '=', $join['table'] . '.' . $join['key']);
                        break;
                }
            }
        }

        switch (config('database.default')) {
            case "mongodb":
                if ($conditions != null) {
                    self::applyCondition($value, $conditions);
                }
                if ($orderby != null) {
                    //self::applyOrderBy($value,$orderby);
                }
                break;
            default:
                if ($select != null) {
                    $value->selectRaw($select);
                }
                if ($conditions != null) {
                    $value->whereRaw($conditions);
                }

                if ($orderby != null) {
                    $value->orderByRaw($orderby);
                }
                break;
        }
        return $value->paginate($limit??10);
    }
    public static function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    public static function paging_query($cmd, $perPage, $page, $total, $options)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $data['start'] = ($page - 1) * $perPage ?? 15;
        $data['limit'] = $perPage;
        // $cmd .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        $value = DB::select($cmd);
        $items = $value; //array_map(function($n){return (array)$n;},$value);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $total, $perPage, $page, $options);
    }
    // endregion
    public static function dictionary($table_name = null, $conditions = null, $orderby = null, $key = null, $field = null)
    {
        $value = DB::table($table_name);
        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        if ($orderby != null) {
            $value->orderByRaw($orderby);
        }

        $result = array_map(
            function ($n) {
                return (array) $n;
            },
            $value->get()->toArray()
        );
        return array_column($result, $field, $key);
    }
    public static function scalar($table_name = null, $conditions = null, $field = null)
    {
        $value = DB::table($table_name);
        switch (config('database.default')) {
            case "mongodb":
                if ($conditions != null) {
                    self::applyCondition($value, $conditions);
                }
                break;
            default:
                if ($conditions != null) {
                    $value->whereRaw($conditions);
                }
                break;
        }
        $result = $value->first();
        if (@$result) {
            if (is_array($result)) {
                $result = (object)$result;
            }
            return @$result->{$field};
        } else {
            return '';
        }
    }
    public static function concat($table_name = null, $conditions = null, $field = null)
    {
        $value =  DB::table($table_name);
        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        $value->selectRaw('GROUP_CONCAT(' . $field . ') as `' . $field . '`');
        $result = $value->first();
        if (@$result) {
            return @$result->{$field};
        } else {
            return '';
        }

        // return DB::table($table_name)->whereRaw($conditions)->get();
    }
    public static function val_max($table_name = null, $conditions = null, $field = null)
    {
        $value = DB::table($table_name)->max($field);
        return $value;
    }
    public static function val_sum($table_name = null, $conditions = null, $field = null)
    {
        $value = DB::table($table_name);
        if ($conditions != null) {
            $value->whereRaw($conditions);
        }

        return $value->sum($field);
    }

    public static function select_group($table_name = null, $conditions = null, $select = null, $group = null)
    {
        $value = DB::table($table_name);
        if ($conditions != null) {
            $value->whereRaw($conditions);
        }
        if ($select != null) {
            $value->selectRaw($select);
        }

        if ($group != null) {
            $value->groupBy(DB::raw($group));
        }

        return $value->get();
    }
    //Query using cache
    /**
     * Summary of select_cache
     *
     * @param  mixed $name
     * @param  mixed $table_name
     * @param  mixed $conditions
     * @param  mixed $orderby
     * @param  mixed $flg
     * @param  mixed $limit
     * @return mixed
     */
    public static function select_cache($name, $table_name = null, $conditions = null, $orderby = null, $flg = null, $limit = null)
    {
        try {
            $minutes = 30;
            if ($flg == false) {
                Cache::pull($name);
            }
            $result = Cache::remember(
                $name,
                $minutes,
                function () use ($table_name, $conditions, $orderby, $limit) {
                    $_value = DB::table($table_name);
                    switch (config('database.default')) {
                        case "mongodb":
                            if ($conditions != null) {
                                //$_value->whereRaw(['$text' => ['$search' => $conditions]]);
                                $_value->where($conditions);
                            }

                            if ($orderby != null && is_array($orderby)) {
                                foreach ($orderby as $order => $type) {
                                    $_value->orderBy($order, $type ?? "asc");
                                }
                            }
                            if ($limit != null) {
                            }
                            break;
                        default:
                            if ($conditions != null) {
                                $_value->whereRaw($conditions);
                            }

                            if ($orderby != null) {
                                $_value->orderByRaw($orderby);
                            }

                            if ($limit != null) {
                                $_value->take($limit);
                            }
                            break;
                    }
                    return  $_value->get();
                }
            );
            return $result;
        } catch (\Throwable $e) {
            throwException($e);
            return [];
        }
    }
    public static function select_field_cache($name, $table_name = null, $conditions = null, $select = null, $orderby = null, $flg = null, $limit = null)
    {
        $minutes = 30;
        if ($flg == false) {
            Cache::pull($name);
        }

        $value = Cache::remember(
            $name,
            $minutes,
            function () use ($table_name, $conditions, $select, $orderby, $limit) {
                //return DB::table($table_name)->get();
                $_value = DB::table($table_name);
                if ($select != null) {
                    $_value->selectRaw($select);
                }

                if ($conditions != null) {
                    $_value->whereRaw($conditions);
                }

                if ($orderby != null) {
                    $_value->orderByRaw($orderby);
                }

                if ($limit != null) {
                    $_value->take($limit);
                }

                return $_value->get();
            }
        );
        return $value;
    }
    public static function find_cache($name, $table_name = null, $conditions = null, $flg = null)
    {
        if (Schema::hasTable($table_name)) {
            $minutes = 30;
            if ($flg == false) {
                Cache::pull($name);
            }

            $value = Cache::remember(
                $name,
                $minutes,
                function () use ($table_name, $conditions) {
                    $_value = DB::table($table_name);
                    switch (config('database.default')) {
                        case "mongodb":
                            if ($conditions != "") {
                                $cons = self::conditionToArray($conditions);
                                foreach ($cons as $con) {
                                    $_value->where($con['condition']);
                                }
                            }
                            break;
                        default:
                            if ($conditions != null) {
                                $_value->whereRaw($conditions);
                            }
                            break;
                    }
                    return $_value->first();
                }
            );
            return $value;
        } else {
            return null;
        }
    }
    public static function find_having_cache($name, $table_name = null, $conditions = null, $flg = null)
    {
        if (Schema::hasTable($table_name)) {
            $minutes = 30;
            if ($flg == false) {
                Cache::pull($name);
            }

            $value = Cache::remember(
                $name,
                $minutes,
                function () use ($table_name, $conditions) {
                    $_value = DB::table($table_name);
                    if ($conditions != null) {
                        $_value->havingRaw($conditions);
                    }

                    return $_value->first();
                }
            );
            return $value;
        } else {
            return null;
        }
    }
    public static function find_field_cache($name, $table_name = null, $select = null, $conditions = null, $flg = null)
    {
        $minutes = 30;
        if ($flg == false) {
            Cache::pull($name);
        }

        $value = Cache::remember(
            $name,
            $minutes,
            function () use ($table_name, $conditions, $select) {
                $_value = DB::table($table_name);
                if ($select != null) {
                    $_value->selectRaw($select);
                }

                if ($conditions != null) {
                    $_value->whereRaw($conditions);
                }

                return $_value->first();
            }
        );
        return $value;
    }
    public static function paging_cache($name, $table_name = null, $conditions = null, $orderby = null, $limit = null, $flg = null)
    {
        $minutes = 30;
        if ($flg == false) {
            Cache::pull($name);
        }

        $value = Cache::remember(
            $name,
            $minutes,
            function () use ($table_name, $conditions, $orderby, $limit) {
                $value = DB::table($table_name);
                switch (config('database.default')) {
                    case "mongodb":
                        if ($conditions != null) {
                            self::applyCondition($value, $conditions);
                        }
                        if ($orderby != null) {
                            $value->orderByRaw($orderby);
                        }
                        break;
                    default:
                        if ($conditions != null) {
                            $value->whereRaw($conditions);
                        }
                        if ($orderby != null) {
                            $value->orderByRaw($orderby);
                        }
                        break;
                }


                return $value->paginate($limit);
            }
        );
        return $value;
    }
    public static function pro($procedure_name = null, $value = null, $flg = false)
    {
        try {
            if ($value != null) {
                return DB::select(DB::raw('CALL  ' . $procedure_name . '(' . $value . ')'));
            } else {
                return DB::select('CALL  ' . $procedure_name);
            }
        } catch (Throwable $exp) {
            LogHelper::write($exp);
        }
    }

    public static function pro_cache($name, $procedure_name = null, $value = null, $flg = false)
    {
        $minutes = 30;
        if ($flg == false) {
            Cache::pull($name);
        }

        $value = Cache::remember(
            $name,
            $minutes,
            function () use ($procedure_name, $value) {
                if ($value != null) {
                    return DB::select('CALL  ' . $procedure_name . '(' . $value . ')');
                } else {
                    return DB::select('CALL  ' . $procedure_name);
                }
            }
        );
        return $value;
    }
    public static function pro_first_cache($name, $procedure_name = null, $value = null, $flg = false)
    {
        $minutes = 30;
        if ($flg == false) {
            Cache::pull($name);
        }

        $value = Cache::remember(
            $name,
            $minutes,
            function () use ($procedure_name, $value) {
                if ($value != null) {
                    return DB::select('CALL  ' . $procedure_name . '(\'' . $value . '\')')[0];
                } else {
                    return DB::select('CALL  ' . $procedure_name)->first();
                }
            }
        );
        return $value;
    }
    //End Query using cache
    /**
     * Summary of remove
     *
     * @param mixed $table_name Table Name
     * @param mixed $field      if[id=NULL] <field: Column[id]-> field>
     * @param mixed $id
     */
    public static function remove($table_name = null, $id = null , $field_id = null)
    {
        return DB::table($table_name)->where($field_id??self::$field_id, $id)->delete();
    }
    public static function removeWhereRaw($table_name = null, $id = null)
    {
        return DB::table($table_name)->whereRaw($id)->delete();
    }
    public static function remove_field($table_name = null, $field = null, $id = null)
    {
        DB::table($table_name)->where($field, $id)->delete();
    }
    public static function remove_condition($table_name = null, $condition = null)
    {
        if ($condition != null) {
            DB::table($table_name)->whereRaw($condition)->delete();
        }
    }
    /**
     * Return ID Record Updated
     *
     * @param  mixed $table_name : Table name
     * @param  mixed $data       : Array [Data]
     * @param  mixed $id         : <ID>
     * @return mixed
     */
    public static function save_data($table_name = null, $data = null, $id = null, $field_id ='id')
    {
        switch (config('database.default')) {
            case "mongodb":
                if (is_numeric($id)) {
                    $id = intval($id);
                }
                DB::table($table_name)->where(self::$field_id, $id)->update($data);
                break;
            default:
                $fields = DB::connection()->getSchemaBuilder()->getColumnListing($table_name);
                foreach ($data as $key => $value) {
                    // set multi language fields
                    //if (array_search($key, $this->fields)!==false)
                    //{
                    //   $this->data[$key] = $this->data[$key];
                    //}
                    // remove fields not exists in DB
                    if (array_search($key, $fields) === false) {
                        unset($data[$key]);
                    }
                }
                if ($id != null && $id !== false) {
                    if(is_array($id))
                    {
                        $result = DB::table($table_name)->where(key($id), current($id))->update($data);
                    }
                    else{
                        // $result = DB::table($table_name)->where($field_id, $id)->update($data);
                        $result = DB::table($table_name)->updateOrInsert([$field_id => $id],$data);
                    }
                    return @$id;
                } else {
                    try {
                        $result = DB::table($table_name)->insertGetId($data);
                        return @$result;
                    } catch (Throwable $exception) {
                        dd($exception->getMessage());
                        self::process_exception($exception);
                    }
                }
                break;
        }
    }

    public static function getLastID()
    {
        return DB::getPdo()->lastInsertId();
    }

    public static function process_exception($exception)
    {
        switch ($exception->getCode()) {
            case 23000: //   dd($exception);
                //"Duplicate entry '86/2/13 Ông Ích Khiêm, phường 14, Quận 11, Thành phố ' for key 'formated_address_unique'"
                $mess = $exception->getPrevious()->errorInfo[2];
                //preg_match_all("[^'](.*)[^']", $mess, $match);
                //dd($match);
                //$key = preg_match ()
                //$entry =
                break;
        }
    }

    /**
     * Update Or Insert
     *
     * @param  mixed $table_name
     * @param  mixed $attributes
     * @param  mixed $merged_attributes
     * @return void
     */
    public static function updateOrCreate($table_name, $attributes, $merged_attributes = null)
    {
        DB::table($table_name)->updateOrInsert($attributes, $merged_attributes ?? $attributes);
    }

    public static function applyOrderBy(&$query, $orderby)
    {
        $orders = explode(",", $orderby);
        if (!empty($orders)) {
            foreach ($orders as $or) {
                $arr = explode(" ", $or);
                if (isset($arr[1])) {
                    $query->orderBy($arr[0], $arr[1]);
                } else {
                    $query->orderBy($arr[0]);
                }
            }
        }
    }
    public static function applyCondition(&$query, $conditions)
    {
        $cons = self::conditionToArray($conditions);
        foreach ($cons as $con) {
            $values =  preg_split('/(=|like)/', $con['condition'], -1, PREG_SPLIT_OFFSET_CAPTURE);

            $oper  = $con['condition'];
            foreach ($values as $v) {
                $oper = str_replace($v[0], "", $oper);
            }

            if (isset($values[0][0]) && isset($values[1][0]) && isset($con["operator"])) {
                if ($values[0][0] != "1" || $values[0][0] != 1) {
                    $v = str_replace("'", "", @$values[1][0]);
                    if (strpos($con['condition'], "is null") !== false) {
                        $query->orWhereNull("is_checked");
                    } else {
                        if ($con["operator"] != "or") {
                            if (is_numeric($v)) {
                                $v = (intval($v));
                            }
                            switch ($oper) {
                                case 'like':
                                    $v = str_replace('%', '', trim($v));
                                    $query->where(trim($values[0][0]), 'regexp', "/^$v/i");
                                    break;
                                default:
                                    $query->where($values[0][0], $v);
                                    break;
                            }
                        } else {
                            $query->orWhere($values[0][0], $v);
                        }
                    }
                }
            } else {
                if ($values[0][0] != "1" || $values[0][0] != 1) {
                    if (strpos($con['condition'], "is null") !== false) {
                        $query->orWhereNull("is_checked");
                    } else {
                        $v = str_replace("'", "", @$values[1][0]);
                        if (is_numeric($v)) {
                            $v = (intval($v));
                        }
                        switch ($oper) {
                            case 'like':
                                $v = str_replace('%', '', trim($v));
                                $query->where(trim($values[0][0]), 'regexp', "/^$v/i");
                                break;
                            default:
                                $query->where(trim($values[0][0]), $v);
                                break;
                        }
                    }
                }
            }
        }
    }
    public static function conditionToArray($conditions)
    {
        $value = [];
        try {
            preg_match_all('/(.*?) (and|or) /', $conditions, $values);
            if (!empty($values[1])) {
                $text = "";
                foreach ($values[1] as $index => $pattern) {
                    $text .=  $values[0][$index];
                    $value[] = ["condition" => $pattern, "operator" => @$values[2][$index - 1]];
                }
                $value[] = ["condition" => str_replace($text, "", $conditions), "operator" => $values[2][$index]];
            } else {
                $value[] = ["condition" => $conditions];
            }
            return $value;
        } catch (\Throwable $e) {
            throwException($e);
            return $value;
        }
    }
}
