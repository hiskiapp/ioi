<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransactionsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set transaction unpaid 1 day ago to expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterday = date('Y-m-d H:i:s', strtotime('-1 day'));

        $transactions = DB::table('transactions')
        ->where('status', 'Unpaid')
        ->where('created_at', '<=', $yesterday)
        ->update([
            'status' => 'Expired',
            'updated_at' => now() 
        ]);

        $this->info('Done!');
    }
}
