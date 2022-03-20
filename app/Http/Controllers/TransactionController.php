<?php

namespace App\Http\Controllers;

use App\Repositories\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $limit = 12;

    public function __construct()
    {
        $this->limit = (int) get_setting('limit_list_transactions', 12);
    }

    public function index()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), [], $this->limit);

        return view('transactions.index', $data);
    }

    public function unpaid()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Unpaid", "Checking"], $this->limit);

        return view('transactions.index', $data);
    }

    public function process()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Process"], $this->limit);

        return view('transactions.index', $data);
    }

    public function shipping()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Shipping"], $this->limit);

        return view('transactions.index', $data);
    }

    public function success()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Success"], $this->limit);

        return view('transactions.index', $data);
    }

    public function expired()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Expired"], $this->limit);

        return view('transactions.index', $data);
    }

    public function show($code)
    {
        $data['transaction'] = Transactions::findByCode(auth()->id(), $code);

        return view('transactions.show', $data);
    }
}
