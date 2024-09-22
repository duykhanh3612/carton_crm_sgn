<?php

namespace App\Traits;
trait Data
{
    protected $data = null;

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }
}
