<?php

namespace App\Traits;
trait Queries
{
    protected $queries = null;

    public function getQueries(){
        return $this->queries;
    }

    public function setQueries($queries){
        $this->queries = $queries;
    }
}
