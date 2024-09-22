<?php

namespace Modules\Plugin\Entities;

class Themes
{
    protected static $location = "";
    protected static $nodes = [];
    protected static $cdn = false;
    public static function instance() {
        return new Themes();
    }

    public function __construct($option = [])
    {

        if(!empty($option['location']))
        {
            self::$location = $option['location'];
        }
    }

    public function add($path)
    {
        if(is_array($path))
        {
            $paths = self::$nodes[self::$location]??[];
            self::$nodes[self::$location] = array_merge($paths, $path);
        }
        else{
            self::$nodes[self::$location][] = $path;
        }

    }

    public static function render($view, $data = [], $isCurrentTheme = false)
    {
        define('assets', asset('themes/admin/'.self::getTheme()).'/');
        $data['content'] = view(($isCurrentTheme?'plugin::'.self::getTheme().".".$view:$view), $data);
        return view('plugin::'.self::getTheme().'.layout.default', $data);
    }
    public static function view($view, $data = [], $isCurrentTheme = false)
    {
        define('assets', asset('themes/admin/'.self::getTheme()).'/');
        $data['content'] = view(($isCurrentTheme?'plugin::'.self::getTheme().".".$view:$view), $data);
        return view('plugin::'.self::getTheme().'.layout.default', $data);

        // define('assets',asset('public/themes/admin/'.self::getTheme()).'/');
        // $data['content']= $view;
        // return view('plugin::'.self::getTheme().'.layout.default', $data);
    }
    public static function modules($view, $data = [])
    {
        $path = "";
        switch($view)
        {
            case "header":
                $path = "modules.header";
                break;
            case "filter":
                $path = "modules.filter";
                break;
        }
        return view('plugin::'.self::getTheme().'.'.$path, $data);
    }
    public static function page($page, $data = [])
    {
        define('assets',asset('public/themes/admin/'.self::getTheme()).'/');
        return view('plugin::'.self::getTheme().'.page.'.$page, $data);
    }
    public static function getTheme()
    {
         return user_config("theme")??"default";
    }

    public static function container($location)
    {
        // self::$location = $location;
        return new self(['location'=> $location]);
    }

    public static function header()
    {
        return view('plugin::partials.header')->render();
    }

    public static function footer()
    {
        return view('plugin::partials.footer')->render();
    }
    public static function plugin()
    {
        return view('plugin::partials.plugin',['nodes'=>self::$nodes['plugin'],'cdn'=>self::$cdn])->render();
    }
    public static function module($module)
    {
        return view('plugin::partials.module',['module'=>$module])->render();
    }

    public static function asset($path = '')
    {
        return url(user_setting("theme").'/'.$path);
    }
}
