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
}
