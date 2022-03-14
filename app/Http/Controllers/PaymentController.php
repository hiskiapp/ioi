<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentConfirmationRequest;
use App\Repositories\PaymentConfirmations;
use App\Repositories\Transactions;
use App\Services\PaymentConfirmationsService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($code)
    {
        abort(503, 'Under Development');
        
        $data['transaction'] = Transactions::findByCode(auth()->id(), $code);

        return view('payment.index', $data);
    }

    public function store($code, PaymentConfirmationRequest $request)
    {
        PaymentConfirmationsService::upload(auth()->id(), $code);

        return back()->with('status', 'We will check the payment soon!');
    }
}
