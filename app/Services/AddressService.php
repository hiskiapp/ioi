<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Address;

class AddressService extends Address
{
    public static function newByRequest($users_id)
    {
        return DB::table('address')->insertGetId([
            'users_id' => $users_id,
            'main_address' => g('main_address'),
            'receive_name' => g('receive_name'),
            'phone' => g('phone'),
            'province' => g('province'),
            'city' => g('city'),
            'district' => g('district'),
            'detail' => g('detail'),
            'note' => g('note'),
            'created_at' => now()
        ]);
    }
}