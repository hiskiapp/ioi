<?php

namespace App\Repositories;

use App\Models\BannersModel;
use Illuminate\Support\Facades\DB;

class Banners extends BannersModel
{
    public static function findAllWithPermalink()
    {
        return DB::table('banners')
            ->join('products', 'products.id', '=', 'banners.products_id')
            ->select('banners.*', 'products.permalink as products_permalink')
            ->get();
    }
}
