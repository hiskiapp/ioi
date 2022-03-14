<?php

namespace App\Http\Controllers;

use App\Repositories\Transactions;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        abort(503, 'Under Development');
        
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id());

        return view('transactions.index', $data);
    }

    public function unpaid()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Unpaid", "Checking"]);

        return view('transactions.unpaid', $data);
    }

    public function process()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Process"]);

        return view('transactions.process', $data);
    }

    public function shipping()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Shipping"]);

        return view('transactions.shipping', $data);
    }

    public function success()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Success"]);

        return view('transactions.success', $data);
    }

    public function expired()
    {
        $data['transactions'] = Transactions::findAllAndPaginate(auth()->id(), ["Expired"]);

        return view('transactions.expired', $data);
    }

    public function show($code)
    {
        $data['transaction'] = Transactions::findByCode(auth()->id(), $code);

        return view('transactions.show', $data);
    }
}
