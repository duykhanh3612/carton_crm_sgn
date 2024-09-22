<?php

namespace Modules\ZaloDevelopers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ZaloDevelopers\Model\OA;
use Modules\ZaloDevelopers\Model\Template;
use Modules\ZaloDevelopers\Model\TemplateInfo;
use Modules\ZaloDevelopers\Model\TemplateSampleData;
use Modules\Plugin\Entities\Themes;
class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['items'] = Template::orderBy("createdTime","desc")->paginate(25);
        return Themes::render('zalodevelopers::template.index', $data);
    }

    function download()
    {
        (new Template())->download();
        return redirect()->back()->withSuccess('Download List Template successfully!');
    }
    function downloadInfo($id)
    {
        $item = TemplateInfo::find($id);
        if(!empty($item))
        {
            $oa = OA::where("name",$item->oa)->first();
            $item->download([], ['access_token' => $oa->access_token]);
            $sample = TemplateSampleData::find($id);
            $sample->download([], ['fill'=>['templateId'=>$id], 'access_token' => $oa->access_token]);
        }
        return redirect()->back()->withSuccess('Download Template Info successfully!');
    }
    function testTemplate($id)
    {
        $item = TemplateInfo::find($id);
        if(!empty($item))
        {
            $paras = json_decode($item->listParams);
            $data = [];
            $data['phone'] = "0908247904";
            foreach($paras as $para)
            {
                switch($para->type)
                {
                    case "DATE":
                        $data[$para->name] = date("d/m/Y");
                        break;
                    default:
                        $data[$para->name] = $para->name;
                        break;
                }
            }
            $item->send($id, $data);
        }
        return redirect()->back()->withSuccess('Download Template Info successfully!');
    }
}
