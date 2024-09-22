<?php

namespace App\Models;

use DB;
use Illuminate\Support\Facades\Schema;


class DbModel
{
    protected $db;
    function __construct($table = null)
    {
        $this->db = DB::table($table);
    }
    public function from($table)
    {
        $this->db = DB::table($table);
    }
    function select($column)
    {
        $this->db->selectRaw($column);
    }
    function where($key, $value = null)
    {
        if ($value === null) {
            $this->db->whereRaw($key);
        } else {
            $this->db->where($key, $value);
        }
    }
    function where_in($key, $value = null)
    {
        if ($value === null) {
            $this->db->whereRaw($key);
        } else {
            $this->db->whereIn($key, $value);
        }
    }
    function or_where($key, $value = null)
    {
        if ($value === null) {
            $this->db->orWhereRaw($key);
        } else {
            $this->db->orWhere($key, $value);
        }
    }
    public function order_by($order)
    {
        $this->db->orderByRaw($order);
    }
    public function first()
    {
        return $this->db->first();
    }
    public function count()
    {
        return $this->db->count();
    }
    public function get()
    {
        return $this->db->get();
    }
    public function update($data = [])
    {
        return $this->db->update($data);
    }
    public function insert($data = [])
    {
        return $this->db->insert($data);
    }
    public function join($table, $where, $type = 'inner')
    {
        $where = explode(" ", $where);
        switch ($type) {
            case 'left':
                return $this->db->leftJoin($table, $where[0], $where[1], $where[2]);
                break;
            case 'right':
                return $this->db->rightJoin($table, $where[0], $where[1], $where[2]);
                break;
            default:
                return $this->db->join($table, $where[0], $where[1], $where[2]);
                break;
        }
    }
    public function group_by($field)
    {
        return $this->db->groupBy($field);
    }
    function table_exists($table)
    {
        return Schema::hasTable($table);
    }
    public function field_data($table) {
        return $this->db->fieldData($table);
    }
}
