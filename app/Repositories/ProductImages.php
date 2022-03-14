<?php
namespace App\Repositories;

use App\Models\ProductImagesModel;
use Illuminate\Support\Facades\DB;

class ProductImages extends ProductImagesModel
{
    public static function getFirstSrcByProductsId($products_id)
    {
        return optional(DB::table('product_images')->where('products_id', $products_id)->first())->src;
    }
}