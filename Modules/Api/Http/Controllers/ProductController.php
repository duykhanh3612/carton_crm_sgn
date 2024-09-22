<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Model\Product;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function featured(Request $request)
    {
        $query = new Product;
        if ($request->type == "newest") {
            $query = $query->orderBy("id");
        }
        if ($request->type == 'sale')
        {
            $query = $query->where('is_sale', "1");
        }
        $query = $query->where("published", 1);
        $query = $query->limit(request('limit')??10);

        $records = $query->get();
        $records->transform(function ($item) {
            if(isset($item->image)) {
                $item->image = url("public/".$item->image);
            }
            return $item;
        });
        $result['data'] =  $records->toArray();
        $result['code'] = 200;
        $result['success'] = true;
        if (method_exists($query, 'getOptions')) {
            $query->getOptions($result, $records);
        }
        return response()->json($result, 200, ['Content-type' => 'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
