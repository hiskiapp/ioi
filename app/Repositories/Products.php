<?php

namespace App\Repositories;

use App\Models\ProductsModel;
use Illuminate\Support\Facades\DB;

class Products extends ProductsModel
{
    public static function findAllByPopularity($limit = 6)
    {
        $data =  DB::table('products')
            ->orderBy('seen_total', 'desc')
            ->limit($limit)
            ->get();

        $images = DB::table('product_images')
            ->whereIn('products_id', $data->pluck('id')->toArray())
            ->get();

        return $data->map(function ($row) use ($images) {
            $row->image = $images->where('products_id', $row->id)->first()->src;

            return $row;
        });
    }

    public static function findAllGroupByCategories(int $limit_categories = 6, int $limit_products = 12)
    {
        $categories = DB::table('categories')
            ->select('id', 'name')
            ->limit($limit_categories)
            ->get();

        $products = DB::table('products')
            ->select('id', 'name', 'permalink', 'price', 'images', 'categories_id')
            ->get();

        $images = DB::table('product_images')
            ->whereIn('products_id', $products->pluck('id')->toArray())
            ->get();

        $products = $products->map(function ($row) use ($images) {
            $row->image = $images->where('products_id', $row->id)->first()->src;

            return $row;
        });

        foreach ($categories as $category) {
            $category->products = $products->where('categories_id', $category->id)->take($limit_products);
        }

        return $categories;
    }

    public static function search($limit = 12, $name = null, $categories_id = null, $sort = 'asc')
    {
        $categories_id = Categories::safetyId($categories_id);
        $products = DB::table('products')
            ->when($name, function($q) use ($name) {
                return $q->where('name', 'ILIKE', "%{$name}%");
            })
            ->when($categories_id, function($q) use($categories_id) {
                return $q->where('categories_id', $categories_id);
            })
            ->select('id', 'name', 'permalink', 'price', 'categories_id')
            ->when($sort, function($q) use($sort) {
                if ($sort == 'desc') {
                    return $q->orderBy('name', 'desc');
                }elseif ($sort == 'in_stock') {
                    return $q->where('stock', '!=', 0);
                }
            })
            ->paginate($limit);

        $images = DB::table('product_images')
            ->whereIn('products_id', pluck_id($products))
            ->get();
        
        foreach ($products as $product) {
            $product->image = optional($images->where('products_id', $product->id)->first())->src;
        }

        return $products;
    }

    public static function findByPermalink($permalink)
    {
        $product = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.categories_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_categories_id')
        ->select('products.*', 'categories.name as categories_name', 'sub_categories.name as sub_categories_name')
        ->where('permalink', $permalink)
        ->first();

        if(!$product) abort('404');

        $product->images = DB::table('product_images')->where('products_id', $product->id)->get()->pluck('src');

        return $product;
    }

    public static function findRelatedProduct($id, $limit = 3)
    {
        $categories_id = optional(DB::table('products')->where('id', $id)->first())->categories_id;
        $related_products = DB::table('products')
        ->where('categories_id', $categories_id)
        ->inRandomOrder()
        ->limit($limit)
        ->get();

        return $related_products;
    }
}
