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
    
    public static function findAllWithTotalProducts($without_zero = true)
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->whereIn('categories_id', pluck_id($categories))->get();

        $categories = $categories->map(function($category) {
            $category->total_products = $category->where('categories_id', $category->id)->count();
        });

        if($without_zero) {
            $categories = $categories->where('total_products', '!=', 0)->all();
        }

        return $categories;
    }
}
