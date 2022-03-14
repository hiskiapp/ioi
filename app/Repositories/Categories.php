<?php

namespace App\Repositories;

use App\Models\CategoriesModel;
use Illuminate\Support\Facades\DB;

class Categories extends CategoriesModel
{
    public static function findAllRandom(int $limit = 6)
    {
        return DB::table('categories')->inRandomOrder()->limit($limit)->get();
    }

    public static function safetyId($id)
    {
        $check = DB::table('categories')->where('id', $id)->first();

        return $check ? $id : null;
    }

    public static function findAllWithTotalProducts($name = null, $without_zero = true)
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('products')
            ->whereIn('categories_id', pluck_id($categories))
            ->when($name, function ($q) use ($name) {
                return $q->where('name', 'LIKE', "%{$name}%");
            })
            ->get();

        $categories = $categories->map(function ($category) use ($products) {
            $category->total_products = $products->where('categories_id', $category->id)->count();

            return $category;
        });

        if ($without_zero) {
            $categories = $categories->where('total_products', '!=', 0)->all();
        }

        return $categories;
    }
}
