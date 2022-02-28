<?php

namespace App\Repositories;

use App\Models\CartsModel;
use Illuminate\Support\Facades\DB;

class Carts extends CartsModel
{
    public static function findAllByUsersId(int $users_id)
    {
        $carts = DB::table('carts')
            ->join('products', 'carts.products_id', '=', 'products.id')
            ->select('carts.*', 'products.id as products_id', 'products.name as products_name', 'products.price as products_price', 'products.permalink as products_permalink')
            ->where('users_id', $users_id)
            ->get();

        $images = DB::table('product_images')
            ->whereIn('products_id', $carts->pluck('products_id')->toArray())
            ->get();

        return $carts->map(function ($row) use ($images) {
            $row->products_image = $images->where('products_id', $row->products_id)->first()->src;

            return $row;
        });
    }
}
