<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Products\Products;
use App\Models\Products\ProductsCate;
use App\Http\Controllers\Home\Controller as Controller;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        $model = new Products();
        $hots = $model->getHots();

        return view('home.index.index',compact(['hots']));
    }



}
