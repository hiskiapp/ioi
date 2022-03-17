<?php

namespace App\Http\Controllers;

use App\Repositories\Carts;
use App\Repositories\Products;
use App\Services\CartsService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $data['items'] = Carts::findAllByUsersId(auth()->id());

        return view('cart.index', $data);
    }

    public function add($products_id)
    {
        $product = Products::find($products_id);
        if (!$product) abort(404, 'Product not found');

        CartsService::addProduct(auth()->id(), $product->id, g('qty', 1));

        return redirect()->route('cart.index')->with(['success' => 'Item added!']);
    }

    public function qty(Request $request)
    {
        $carts = Carts::find($request->id);
        if (!$carts) return response()->json(['error' => 'Item not found'], 404);

        $total_order = $request->total_order ? $request->total_order : 0;
        CartsService::updateTotalOrder($request->id, $total_order);

        $product = Products::find($carts->products_id);
        $subtotal = $product->price * $total_order;
        $total = CartsService::getTotal(auth()->id());

        return response()->json([
            'success' => 'Total order updated',
            'subtotal' => number_format($subtotal),
            'total' => number_format($total)
        ], 200);
    }

    public function destroy($id)
    {
        $carts = Carts::find($id);
        if (!$carts) abort(404, 'Item not found');

        Carts::deleteById($id);

        return redirect()->back()->with(['success' => 'Item deleted!']);
    }
}
