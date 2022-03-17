<?php

namespace App\Http\Controllers;

use App\Repositories\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id());

        return view('transactions.index', $data);
    }

    public function unpaid()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Unpaid", "Checking"]);

        return view('transactions.index', $data);
    }

    public function process()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Process"]);

        return view('transactions.index', $data);
    }

    public function shipping()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Shipping"]);

        return view('transactions.index', $data);
    }

    public function success()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Success"]);

        return view('transactions.index', $data);
    }

    public function expired()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Expired"]);

        return view('transactions.index', $data);
    }

    public function show($code)
    {
        $data['transaction'] = Transactions::findByCode(auth()->id(), $code);

        return view('transactions.show', $data);
    }
}
