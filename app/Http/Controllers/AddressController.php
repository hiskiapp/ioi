<?php

namespace App\Http\Controllers;

use App\Repositories\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function show($id)
    {
        $data = Address::findBy(['users_id' => auth()->id(), 'id' => $id]);
        if (request()->ajax()) {
            return response()->json(['data' => $data]);
        }

        abort(404);
    }
}
