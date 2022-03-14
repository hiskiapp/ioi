<?php

namespace App\Http\Controllers;

use App\Repositories\Categories;
use App\Repositories\Products;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        abort(503, 'Under Development');
        
        $search = g('q');
        $categories_id = g('categories_id');
        $sort = g('sort', 'asc');

        $data['popular_products'] = Products::findAllByPopularity(4); 
        $data['products'] = Products::search(12, $search, $categories_id, $sort);
        $data['categories'] = Categories::findAllWithTotalProducts();

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
