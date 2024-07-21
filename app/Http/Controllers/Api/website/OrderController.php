<?php

namespace App\Http\Controllers\Api\website;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->get();
        return response()->json($orders);
    }
//  request TODO
    public function create(Request $request)
    {
        $order = Auth::user()->orders()->create();
// try , catch , begin transaction
try {
    $totalPrice = 0;
    foreach ($request->items as $item) {
        $product = Product::find($item['product_id']);

        if ($product) {
            $price = $product->offer_price * $item['quantity'];
            $totalPrice += $price;

            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        } else {
            throw new Exception("Product with ID {$item['product_id']} not found.");
        }
    }
    $order->total_price = $totalPrice;
    $order->save();
} catch (Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}


        return response()->json($order->load('items.product'));
    }
}

