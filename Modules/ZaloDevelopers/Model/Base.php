<?php

namespace Modules\ZaloDevelopers\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\CoreVar;
use App\Models\ClientLog;
use App\Services\Zalo\ZNS as Client;
use App\Events\BeforeUpsert;
use App\Events\AfterUpsert;
use App\Events\BeforeSave;
use App\Events\AfterSave;
use function Ramsey\Uuid\v1;
use Arr;

class Base extends Model
{
    protected $guarded = [];
    protected $client;
    const ZNS_DATE_FORMAT = "Y-m-d\TH:i:s";

    public function __construct($options = array(), $attributes = array())
    {
        parent::__construct($attributes);
        $this->attributes = $attributes;
        $this->client = new Client();
        $this->clientLog = new ClientLog(auth()->user()->id ?? 0);
    }

    public static function saveData($key = [], $data = [])
    {
        self::updateOrCreate($key, $data);
    }
    public static function scopeFilter($query, $request)
    {
        $noFilter = $request->get('no_filter');
        $filter = isset($noFilter) && is_array($noFilter) ? $noFilter : $request->filter;
        if (is_array($filter) && count($filter)) {
            foreach ($filter as $key => $item) {
                if (is_array($item) && count($item)) {
                    if ($item['from']) {
                        $query->where($key . ' >= "' . trim($item['from']) . ' 00:00:00"');
                    }
                    if ($item['to']) {
                        $query->where($key . ' <= "' . trim($item['to']) . ' 23:59:59"');
                    }
                } else {
                    $item = trim($item);
                    if ($item != '') {
                        if ($item == 'Yes' || $item == 'No') {
                            if ($item == 'Yes') {
                                $item = 1;
                            }
                            if ($item == 'No') {
                                $item = 0;
                            }
                            $query->where('(' . $key . ' LIKE "%' . $item . '%" OR ' . $key . ' = "' . $item . '")');
                        } else {
                            $query->where($key, 'like', $item);
                            if ($key == 'Status') {
                                $query->where($key, $item);
                            }
                        }
                    }
                }
            }
        }
        // $query->where('deleted', '0');
        $query->where('language_code', !empty($request->language_code) ? $request->language_code : 'vi');
        return $query;
    }

    public function scopeSearch($q, $params = [])
    {
        return $q;
    }

    public function download($ids = [], array $filters = [])
    {
        // if (!$this->client->validateSetting(true)) {
        //     $this->clientLog->write('Lightspeed has not been authorized yet!');
        //     return 'Service has not been authorized yet!';
        // }
        // $accountId = "";
        // if(static::$accountFilter) {
        //     $accountId = Account::accountId($this->module);
        //     if(!$accountId) {
        //         $this->clientLog->write('Can not download account Lightspeed!');
        //         return 'Can not download account Lightspeed!';
        //     }
        // }
        $logKey = 'DOWNLOAD_ZALOTEMPLATE_' . $this->getDataField();
        $date = gmdate(self::ZNS_DATE_FORMAT);
        $hasError = false;
        $count = 0;
        try {
            $query = [];
            $coreVar = null;
            if (empty($ids) && empty($filters)) {
                $key = "zalo-download-".strtolower($this->getDataField()) ."-last-time";
                $coreVar = CoreVar::firstOrCreate(['core_key' => $key]);
                if ($coreVar->core_value) {

                    $this->clientLog->write($coreVar->core_value, "$logKey::lastTime");

                    if(class_basename($this) === 'TemplateInfo') {
                        $formatted = gmdate("Y-m-d\TH:i:s\Z" , strtotime($coreVar->core_value));
                        // $filters['or'] = [
                        //     'timeStamp' => "=>,{$formatted}",
                        //     'ItemShops.timeStamp' => "=>,{$formatted}",
                        //     'Images.timeStamp' => "=>,{$formatted}",
                        //     'ItemPrices.timeStamp' => "=>,{$formatted}",
                        // ];
                        foreach($this->query_paras as $para_key => $para_name )
                        {
                            $query[$para_key] = $this->{$para_name};
                        }
                        $query['offset'] = 0;
                        $query['limit'] = 100;
                        // $query['status'] = 2;
                    }
                    else {

                        $query['offset'] = 0;
                        $query['limit'] = 100;
                        // $query['status'] = 2;
                    }

                }
                else{

                    if(class_basename($this) === 'TemplateInfo') {
                        foreach($this->query_paras as $para_key => $para_name )
                        {
                            $query[$para_key] = $this->{$para_name};
                        }
                    }
                    else{
                        $query['offset'] = 0;
                        $query['limit'] = 100;
                        // $query['status'] = 1;
                    }

                }
            }
            else{
                if(in_array(class_basename($this),['TemplateInfo','TemplateSampleData'])) {
                    foreach($this->query_paras as $para_key => $para_name )
                    {
                        $query[$para_key] = $this->{$para_name};
                    }
                }
                else{
                    $query['offset'] = 0;
                    $query['limit'] = 100;
                    // $query['status'] = 1;
                }
            }
            if (!empty($ids)) {
                $filters[$this->getKeyField()] = $ids;
            }

            // if ($this->orderBy) {
            //     $query['orderby'] = $this->orderBy;
            // }
            // if ($this->orderByDesc) {
            //     $query['orderby_desc'] = 1;
            // }
            // if (isset($this->archived)) {
            //     $query['archived'] = $this->archived;
            // }
            // if (!empty($this->loadRelations)) {
            //     if ($this->loadRelations === 'all') {
            //         $query['load_relations'] = 'all';
            //     } else {
            //         $query['load_relations'] = urlencode(json_encode($this->loadRelations));
            //     }
            // }
            // $finalFilters = array_merge($this->filters, $filters);
            // if (!empty($finalFilters)) {
            //     $queryFilters = static::buildFilters($finalFilters);
            //     $query = array_merge($query, $queryFilters);
            //     $query = array_merge($query, $queryFilters);
            // }
            // $this->clientLog->write($query, "$logKey::query");
            $queryString = '';
            if (!empty($query)) {
                $queryString = '?' . static::buildQuery($query);
            }
            if(strpos($this->endpoint, "http" ) === false)
            {
                $uri  = $this->endpoint . $queryString;
            }
            else{
                $uri  = $this->endpoint;
            }

            if(isset($filters['access_token']))
            {
                $this->client->load_access_token($filters['access_token']);
            }
            if(isset($filters['template_id']))
            {
                $this->client->load_template_id($filters['template_id']);
            }

            $response = $this->client->request("GET", $uri);

            // dd($response, $this->endpoint . $queryString);
            // $response = [
            //     "success" => true,
            //     "code" => 200,
            //     "message" => "Success",
            //     "data" => [
            //         0 => [
            //             'templateId' => 2386,
            //             'templateName' => "Test",
            //             'createdTime' =>  "1",
            //             'status' => "Enable",
            //             'templateQuality' => 0

            //         ]
            //     ],
            //     "headers" =>  []
            // ];
            if ($response['success']) {
                // $count = (int)Arr::get($response, 'data.@attributes.count');
                // $this->clientLog->write($count, "$logKey::total");
                // $offset = (int)Arr::get($response, 'data.@attributes.offset');
                // $this->clientLog->write($offset, "$logKey::offset");
                // $limit = (int)Arr::get($response, 'data.@attributes.limit');
                $count = count($response['data']);

                if ($count) {
                    $items = Arr::get($response, 'data');
                    if ($items && !isset($items[0])) {
                        if(method_exists($this,'tranformData'))
                        {
                            $items = $this->tranformData($items);
                        }

                        if(isset($filters['id']))
                        {
                            $items['id'] = $filters['id'];
                        }

                        if(boolval(@$this->save_as_json))
                        {
                            $items = [$this->save_as_field => json_encode($items)];
                        }
                        else{
                            $items = [$items];
                        }
                        if(isset($filters['fill']))
                        {
                            foreach($filters['fill'] as $fill_key => $fill_value)
                            {
                                $items[$fill_key] =  $fill_value;
                            }
                        }
                    }
                    else{
                        if(isset($filters['fill']))
                        {
                            foreach($filters['fill'] as $fill_key => $fill_value)
                            {
                                $items = data_fill($items, "*.". $fill_key, $fill_value);
                            }
                        }
                    }
                    $this->writeData($items);

                    //Handel call next step
                    // if ($limit && $count > $limit) {
                    //     $query['limit'] = $limit;
                    //     //Download next page
                    //     $offset = $limit;
                    //     while ($offset < $count) {
                    //         $this->clientLog->write($offset, "$logKey::offset");
                    //         $query['offset'] = $offset;
                    //         $queryString = '?' . static::buildQuery($query);
                    //         $response = $this->client->get($this->getEndPoint() . $queryString);
                    //         if ($response['success']) {
                    //             $items = Arr::get($response, 'data.' . $this->getDataField());
                    //             if ($items && !isset($items[0])) {
                    //                 $items = [$items];
                    //             }
                    //             $this->writeData($items);
                    //         } else {
                    //             $this->clientLog->write($response);
                    //             $hasError = true;
                    //             break;
                    //         }
                    //         $offset += $limit;
                    //     }
                    // }
                }
            } else {
                write_log($response, "Download::Error");
                $hasError = true;
            }
        } catch (\Throwable $exception) {
            $hasError = true;
            write_log($exception->getMessage(), "$logKey::exception");
        }
        if (isset($coreVar) && !empty($count) && !$hasError) {
            $coreVar->update(['core_value' => $date]);
        }
        write_log($count, "$logKey::result");
        return $count;
    }
    public static function buildQuery(array $query = []): string
    {
        $temp = [];
        foreach ($query as $key => $value) {
            $temp[] = "$key=$value";
        }
        return implode("&", $temp);
    }
    public function getDataField(): string
    {
        if (!$this->dataField) {
            $this->dataField = class_basename(static::class);
        }
        return $this->dataField;
    }
    public function writeData($items = [])
    {
        // $this->beforeUpsert($items);
        $this->bulkUpsert($items);
        // $this->afterUpsert($items);
    }
    public function beforeUpsert(array &$items)
    {
        $items = array_map(function ($item) {
            $item = $this->getAdditionalData($item);
            return $item;
        }, $items);
    }

    public function bulkUpsert($docs = array())
    {
        try {
            if ($docs) {
                // event(new BeforeUpsert($this, $docs));

                if(config("database.default") == "mysql")
                {
                    // self::insert($docs);
                    self::upsert($docs,self::$primaryKey??"id");
                }
                else{
                    $collection = $this->getConnection()->getMongoDB()->selectCollection($this->collection);
                    $collection->bulkWrite($this->data);
                }
                // event(new AfterUpsert($this, $docs));
                // $this->removeDuplicate($docs);
            }
            return 1;
        } catch (\Throwable $e) {
            write_log($e->getMessage(), "BulkUpsertException");
            return 0;
        }
    }
    public function afterUpsert($items = array()) {
        try {
            if(!$this->hsItemClass){
                return 0;
            }
            $count = 0;
            if($items){
                $itemToUpdate = array();
                foreach($items as $item){
                    $hsItem = $this->convertToHyperspace($item);
                    if($hsItem && is_array($hsItem)){
                        if(!empty($this->hsAllowedFields)){
                            foreach($item as $field => $val){
                                if(!in_array($field, $this->hsAllowedFields)){
                                    unset($item[$field]);
                                }
                            }
                        }
                        if(!empty($this->hsIgnoredFields)){
                            foreach($this->hsIgnoredFields as $ignoredField){
                                unset($item[$ignoredField]);
                            }
                        }
                        $hsItem = array_replace($item, $hsItem);
                        $itemToUpdate[] = $hsItem;
                    }
                }
                if($itemToUpdate){
                    $itemClass = $this->hsItemClass;
                    $itemM = new $itemClass();
                    $itemM->bulkUpsert($itemToUpdate);
                    $count = count($itemToUpdate);
                }
            }
            return $count;
        } catch (\Throwable $e) {
            $this->clientLog->write($e->getMessage());
            return 0;
        }
    }
}
