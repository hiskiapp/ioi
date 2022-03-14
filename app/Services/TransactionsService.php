<?php

namespace App\Services;

use App\Repositories\Carts;
use Illuminate\Support\Facades\DB;
use App\Repositories\Transactions;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class TransactionsService extends Transactions
{
    public static function generateCode()
    {
        $number = DB::table('transactions')->count() + 1;
        $label = get_setting('label_transactions', 'INV');
        $noc = get_setting('noc_transactions', 5);

        return $label . str_pad((string) $number, $noc, '0', STR_PAD_LEFT);
    }

    public static function checkout($users_id)
    {
        $code = static::generateCode();
        $total_price = Carts::getTotalPriceByUsersId($users_id);
        $total_item = Carts::getTotalItemByUsersId($users_id);

        DB::table('transactions')->insert([
            'users_id' => $users_id,
            'payment_methods_id' => g('payment_methods_id'),
            'address_id' => g('address_id', AddressService::newByRequest($users_id)),
            'code' => $code,
            'total_price' => $total_price,
            'total_item' => $total_item,
            'status' => 'Unpaid',
            'created_at' => now(),
        ]);

        $transactions_id = DB::getPdo()->lastInsertId();
        $items = Carts::findAllByUsersId($users_id);
        $transaction_items = [];
        foreach ($items as $item) {
            $transaction_items[] = [
                'transactions_id' => $transactions_id,
                'products_id' => $item->products_id,
                'quantity' => $item->total_order,
                'price_item' => $item->products_price,
            ];
        }

        DB::table('transaction_items')->insert($transaction_items);

        CartsService::clear($users_id);

        CRUDBooster::sendNotification([
            'content' => "New Transaction: $code",
            'to' => CRUDBooster::adminPath('transactions'),
            'id_cms_users' => [1, 2],
        ]);
    }
}
