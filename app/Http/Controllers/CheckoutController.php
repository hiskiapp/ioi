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
        $items = Carts::getTotalItemByUsersId(auth()->id());
        if (!$items) return redirect()->route('cart.index')->with(['success' => 'Cart empty!']);

        $data['items'] = Carts::findAllByUsersId(auth()->id());
        $data['addresses'] = Address::findAllBy('users_id', auth()->id());
        $data['payments'] = PaymentMethods::findAll();

        return view('checkout.index', $data);
    }

    public function store(CheckoutRequest $request)
    {
        $items = Carts::getTotalItemByUsersId(auth()->id());
        if (!$items) return redirect()->route('cart.index')->with(['success' => 'Cart empty!']);

        TransactionsService::checkout(auth()->id());

        return redirect()->route('orders.index')->with('status', 'Your order has been placed!');
    }
}
