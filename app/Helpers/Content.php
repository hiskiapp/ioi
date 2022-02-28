<?php

use App\Repositories\Carts;
use App\Repositories\Categories;
use Illuminate\Support\Facades\DB;

if (!function_exists('random_categories')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function random_categories(int $limit = 6)
    {
        return Categories::findAllRandom($limit);
    }
}

if (!function_exists('cart_items')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function cart_items()
    {
        return Carts::findAllByUsersId(auth()->id());
    }
}
