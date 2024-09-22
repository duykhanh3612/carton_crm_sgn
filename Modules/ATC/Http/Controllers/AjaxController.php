<?php

namespace Modules\ATC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AjaxController extends Controller
{
    public function getViewByType(Request $request, $type)
    {
        $data = [
            'type'     => $type,
            'name'     => $request->name,
            'value'    => $request->value,
            'id'    => null,
            'mask'    => $request->mask
        ];
        $view = view()->exists("atc::components.input.$type") ? "components.input.$type" : 'components.input.text';
        return load_view($view, $data, "atc");
    }

    public function upload_file()
    {
        $data = upload(request()->files, "upload/images");
        return response()->json(['image' => reset($data)]);
    }
}
