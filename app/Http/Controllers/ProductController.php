<?php

namespace App\Http\Controllers;

use App\Repositories\Categories;
use App\Repositories\Products;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $search = g('q');
        $categories_id = g('categories_id');
        $sort = g('sort', 'asc');
        $limit_products = (int) get_setting('pagination_products', 12);
        $limit_top_products = (int) get_setting('limit_top_products', 4);

        $data['popular_products'] = Products::findAllByPopularity($limit_top_products);
        $data['count_products'] = Products::countAll();
        $data['products'] = Products::search($limit_products, $search, $categories_id, $sort);
        $data['categories'] = Categories::findAllWithTotalProducts($search, false);

        return view('products.index', $data);
    }

    public function show($slug)
    {
        $data['product'] = Products::findByPermalink($slug);
        $data['related_products'] = Products::findRelatedProduct($data['product']->id);

        ProductsService::addSeenTotal($data['product']->id);

        return view('products.show', $data);
    }
}
