<?php
namespace App\Models;

use App\Helpers\LogHelper;

class ClientLog {

    protected $path = null;
    protected $clientId = null;

    public function __construct($clientId = 0){
        $this->clientId = $clientId;
    }

    public function write($data = null, $key = null) {
        LogHelper::write($data, $key, $this->clientId);
    }

    public function memoryUsage($key = null) {
        LogHelper::memoryUsage($key, $this->clientId);
    }
}