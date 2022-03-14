<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Repositories\Address;
use App\Repositories\Carts;
use App\Repositories\PaymentMethods;
use App\Repositories\Transactions;
use App\Services\AddressService;
use App\Services\TransactionsService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        abort(503, 'Under Development');
        
        $data['items'] = Carts::findAllByUsersId(auth()->id());
        $data['addresses'] = Address::findAllBy('users_id', auth()->id());
        $data['payments'] = PaymentMethods::findAll();

        return view('checkout.index', $data);
    }

    public function store(CheckoutRequest $request)
    {
        TransactionsService::checkout(auth()->id());
        
        return redirect()->route('order.index')->with('status', 'Your order has been placed!');
    }
}
