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
            ->select('carts.*', 'products.id as products_id', 'products.name as products_name', 'products.price as products_price', 'products.permalink as products_permalink', 'products.stock as products_stock')
            ->where('users_id', $users_id)
            ->where('total_order', '>=', 1)
            ->get();

        $images = DB::table('product_images')
            ->whereIn('products_id', $carts->pluck('products_id')->toArray())
            ->get();

        return $carts->map(function ($row) use ($images) {
            $row->products_image = $images->where('products_id', $row->products_id)->first()->src;

            return $row;
        });
    }

    public static function getTotalPriceByUsersId(int $users_id)
    {
        $items = static::findAllByUsersId($users_id);

        $total = 0;
        foreach ($items as $item) {
            $total += $item->total_order * $item->products_price;
        }

        return $total;
    }

    public static function getTotalItemByUsersId(int $users_id)
    {
        $items = static::findAllByUsersId($users_id);

        return $items->sum('total_order');
    }
}
