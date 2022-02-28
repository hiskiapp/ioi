<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function update(AccountRequest $request)
    {
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : auth()->user()->password,
        ]);

        return back()->with('status', 'Account updated successfully.');
    }
}
