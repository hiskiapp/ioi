<?php

namespace App\Repositories;

use App\Models\TransactionsModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transactions extends TransactionsModel
{
    public static function findAllAndPaginate($users_id, $status = [], $limit = 12)
    {
        $transactions = DB::table('transactions')
            ->where('users_id', $users_id)
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        $transaction_items = DB::table('transaction_items')
            ->join('products', 'products.id', 'transaction_items.products_id')
            ->whereIn('transaction_items.transactions_id', pluck_id($transactions))
            ->select('transaction_items.*', 'products.id as products_id', 'products.name as products_name')
            ->get();

        foreach ($transactions as $transaction) {
            $items = $transaction_items->where('transactions_id', $transaction->id);
            $transaction->items = Str::limit($items->pluck('products_name')->implode(', '), 42);
            $transaction->thumb = ProductImages::getFirstSrcByProductsId($items->first()->products_id);
        }

        return $transactions;
    }

    public static function findByCode($users_id, $code)
    {
        $transaction = DB::table('transactions')
            ->join('payment_methods', 'payment_methods.id', 'transactions.payment_methods_id')
            ->join('address', 'address.id', 'transactions.address_id')
            ->where('transactions.users_id', $users_id)
            ->where('transactions.code', $code)
            ->first();

        abort_if(!$transaction, 404, 'Transaction Not Found');

        $transaction->items = DB::table('transaction_items')
            ->join('products', 'products.id', 'transaction_items.products_id')
            ->where('transaction_items.transactions_id', $transaction->id)
            ->select('transaction_items.*', 'products.id as products_id', 'products.name as products_name',  'products.permalink as products_permalink')
            ->get();

        foreach ($transaction->items as $row) {
            $row->image = ProductImages::getFirstSrcByProductsId($row->products_id);
        }

        return $transaction;
    }
}
