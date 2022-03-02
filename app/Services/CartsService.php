<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Carts;

class CartsService extends Carts
{
    public static function addProduct($users_id, $products_id, $total_order = 1)
    {
        $check = DB::table('carts')->where('users_id', $users_id)->where('products_id', $products_id)->first();
        if ($check) {
            static::addTotalOrder($check->id, $total_order);
        } else {
            DB::table('carts')->insert([
                'users_id' => $users_id,
                'products_id' => $products_id,
                'total_order' => $total_order,
                'created_at' => now(),
            ]);
        }
    }

    public static function addTotalOrder(int $id, int $total_order = 1)
    {
        $data = DB::table('carts')->where('id', $id)->first();
        if ($data) {
            $total_order = $data->total_order + $total_order;

            DB::table('carts')->where('id', $id)->update([
                'total_order' => $total_order,
                'updated_at' => now(),
            ]);
        }
    }

    public static function updateTotalOrder(int $id, int $total_order = 1)
    {
        $data = DB::table('carts')->where('id', $id)->first();
        if ($data) {
            DB::table('carts')->where('id', $id)->update([
                'total_order' => $total_order,
            ]);
        }
    }

    public static function getTotal($users_id)
    {
        $items = static::findAllByUsersId($users_id);
        $total = 0;
        foreach ($items as $item) {
            $total += $item->total_order * $item->products_price;
        }

        return $total;
    }
}
