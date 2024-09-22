<?php

namespace Modules\Modules\Http\Controllers;

use App\Models\FnModel;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use \Illuminate\Foundation\AliasLoader;
use Config;
use Modules\Admin\Model\Modules;

class BaseController extends Controller
{
    const UNKNOW_ERROR_MESSAGE = 'Unknown errors.';
    const HS_KEY = 'hs_key';
    const HS_VAL = 'hs_val';
    const HS_MULTIPLE = 'hs_multiple';
    const HS_SEPARATOR = 'hs_separator';
    const HS_DATA_TYPE = 'hs_data_type';
    const HS_IS_MAP_FIELD = 'is_map_field';
    const HS_TITLE = "hs_title";
    const HS_WITH_TITLE = "with_option_title_";
    const HS_GROUP = "hs_group";
    const HS_LEVEL = "hs_level";
    private $defaultLimit = 10;
    public $model = [
        'order' => \Modules\Admin\Model\Order::class,
        'order_status' => \Modules\Admin\Model\OrderStatus::class,
        'customer' => \Modules\Admin\Model\Customer::class,
        'product' => \Modules\Admin\Model\Product::class,
        'product_category' => \Modules\Admin\Model\ProductCategory::class,
        'news' => \Modules\Admin\Model\News::class,
        'pages' => \Modules\Admin\Model\Pages::class,
        'user' => \Modules\Admin\Model\Users::class,
        'users'=> \Modules\Admin\Model\Users::class,
        'group' => \Modules\Admin\Model\Groups::class,
        'geo_province' => \Modules\Admin\Model\GeoProvince::class,
        'geo_district' => \Modules\Admin\Model\GeoDistrict::class,
        'geo_ward' => \Modules\Admin\Model\GeoWard::class,
        'payment_type'=>\Modules\Admin\Model\PaymentType::class,
  		'modules' => \Modules\Admin\Model\Modules::class,
    ];
    protected $fn;
    protected $module;
    protected $table;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(request()->segment(1)!= "api")
            {
                if(@auth()->user()->id)
                {
                    $permission = \Modules\Admin\Model\UsersPermission::where("user_id",auth()->user()->id)->get()->keyBy("function_id");
                    $user = auth()->user()->load(['UserRoles']);
                    $roles = collect($user->UserRoles)->pluck("id")->toArray();
                    Config::set('roles', $roles);
                    view()->share("per",$permission);
                    if(!is_array(env("APP_PATH")))
                    {
                        define('base',url(env("APP_PATH")).'/');
                    }

                }

                view()->share('model', $this->model);

                $this->module = Modules::where("file", request()->segment(2))->first();
	            if (!empty($this->module)) {
                    $this->fn = new FnModel();
                    $this->fn->load_config(@$this->module->file);
	                $this->table = $this->module->prefix ?? $this->module->file;
	                view()->share("module", $this->module);
	            }
            }

            $this->registerClass();
            return $next($request);
        });


    }
    public function registerClass()
    {
        $loader = AliasLoader::getInstance();
        // $modules = array_map('basename', File::files(base_path('modules/' . alias . '/Model')));

        // foreach ($modules as $module) {
        //     $name = str_replace(".php", "", $module);
        //     $className = "\modules\\" . alias . "\Model\\" . $name;
        //     $loader->alias($name, '' . $className. ''::class);
        // }

        $loader->alias("Admin", \App\Models\Admin::class);
        $loader->alias("Geo", \App\Models\Geo::class);
        $loader->alias("Users",  \Modules\Admin\Model\Users::class);
        $loader->alias("Groups",  \Modules\Admin\Model\Groups::class);
        $loader->alias("Modules",  \Modules\Admin\Model\Modules::class);
        $loader->alias("Customer",  \Modules\Admin\Model\Customer::class);
        $loader->alias("Product",  \Modules\Admin\Model\Product::class);

    }
    public function prepareSearch(Request $request, $sortDefault = 'id'): void
    {
        request()->merge([
            'limit' => (int)$request->get('limit', $this->defaultLimit),
            'current_tab' => $request->get('current_tab', 0),
            'weborder' => $request->get('weborder', 0),
            'keywords' => $request->get('keywords', ''),
            'sort_column' => $request->get('sort_column', 0),
            'sort_field' => $request->get('sort_field', $sortDefault),
            'sort_order' => $request->get('sort_order', 'desc'),
        ]);
    }
    public function render($view, $data) {
        $data['content'] = view("admin::".$view,$data);
        return view('admin::layouts.template',$data);
    }
}
