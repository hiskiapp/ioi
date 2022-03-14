<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Products;

class ProductsService extends Products
{
    public static function addSeenTotal($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if($product) {
            DB::table('products')->where('id', $product->id)->update([
                'seen_total' => $product->seen_total + 1,
            ]);
        }
    }
}