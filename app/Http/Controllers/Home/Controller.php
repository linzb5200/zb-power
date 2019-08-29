<?php

namespace App\Http\Controllers\Home;

use App\Models\Color;
use App\Models\Style;
use App\Models\Trades;
use App\Models\Products\ProductsCate;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $user;
    protected $settings;
    protected $nav;
    protected $costCate;
    protected $costColors;
    protected $costStyles;
    protected $costTrades;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->settings = settings();
            view()->share('settings',$this->settings);

            $model = new ProductsCate();
            $this->nav = $model->getCacheList(1);
            view()->share('nav',$this->nav);

            $modelCate = new ProductsCate();
            $this->costCate = $modelCate->getCacheList();
            view()->share('costCate',$this->costCate);

            $modelColor = new Color();
            $this->costColors = $modelColor->getCacheList();
            view()->share('costColors',$this->costColors);

            $modelStyle = new Style();
            $this->costStyles = $modelStyle->getCacheList();
            view()->share('costStyles',$this->costStyles);

            $modelTrades = new Trades();
            $this->costTrades = $modelTrades->getCacheList();
            view()->share('costTrades',$this->costTrades);

            return $next($request);
        });
    }

}
