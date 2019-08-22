<?php

namespace App\Http\Controllers\Home;

use App\Models\Products\ProductsCate;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $settings;
    protected $navs;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->settings = settings();
            view()->share('settings',$this->settings);

            $model = new ProductsCate();
            $this->navs = $model->getCacheList(1);
            view()->share('navs',$this->navs);

            return $next($request);
        });
    }

}
