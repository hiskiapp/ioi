<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentConfirmationRequest;
use App\Repositories\PaymentConfirmations;
use App\Repositories\PaymentMethods;
use App\Repositories\Transactions;
use App\Services\PaymentConfirmationsService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($code)
    {
        $data['transaction'] = Transactions::findByCode(auth()->id(), $code);
        abort_if(!in_array($data['transaction']->status, ['Unpaid', 'Checking']), 404);
        $data['payments'] = PaymentMethods::findAll();

        return view('payment.index', $data);
    }

    public function store($code, PaymentConfirmationRequest $request)
    {
        PaymentConfirmationsService::upload(auth()->id(), $code);

        return redirect()->route('transactions.show', $code)->with('success', 'We will check the payment soon!');
    }
}
