<?php

namespace App\Http\Controllers;

use App\Repositories\Banners;
use App\Repositories\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['banners'] = Banners::findAllWithPermalink();
        $data['popular_products'] = Products::findAllByPopularity();
        $data['all_products'] = Products::findAllGroupByCategories();
        return view('home.index', $data);
    }
}
