<?php

namespace App\Http\Controllers;

use App\Repositories\Banners;
use App\Repositories\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $limit_popularity = (int) get_setting('pagination_popularity', 6);
        $limit_categories = (int) get_setting('pagination_categories', 6);
        $limit_products = (int) get_setting('pagination_products_by_categories', 12);

        $data['banners'] = Banners::findAllWithPermalink();
        $data['popular_products'] = Products::findAllByPopularity($limit_popularity);
        $data['all_products'] = Products::findAllGroupByCategories($limit_categories, $limit_products);

        return view('home.index', $data);
    }
}
