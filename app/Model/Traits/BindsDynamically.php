<?php
namespace App\Model\Traits;
trait BindsDynamically
{
    protected $connection = null;
    protected $table = null;

    public function bind(string $connection,$table)
    {
        $this->setConnection($connection);
        $this->setTable($table);
    }

    public function newInstance($attributes = [], $exists = false)
    {
        // Overridden in order to allow for late table binding.

        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->table);

        return $model;
    }

}