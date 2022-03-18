<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\PaymentConfirmations;
use App\Repositories\Transactions;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class PaymentConfirmationsService extends PaymentConfirmations
{
    public static function upload($users_id, $code)
    {
        $transaction = Transactions::findByCode($users_id, $code);

        DB::table('transactions')->where('id', $transaction->id)->update([
            'updated_at' => now(),
            'status' => 'Checking',
            'payment_methods_id' => g('payment_methods_id')
        ]);

        DB::table('payment_confirmations')->updateOrInsert([
            'transactions_id' => $transaction->id,
        ], [
            'proof' => CRUDBooster::uploadFile('proof', true),
            'sender_name' => g('sender_name'),
            'sender_number' => g('sender_number'),
            'status' => "Pending",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        CRUDBooster::sendNotification([
            'content' => "Check Payment Transaction: {$transaction->code}",
            'to' => CRUDBooster::adminPath("transactions/payment/{$transaction->id}"),
            'id_cms_users' => [1, 2],
        ]);
    }
}
