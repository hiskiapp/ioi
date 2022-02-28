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
}
