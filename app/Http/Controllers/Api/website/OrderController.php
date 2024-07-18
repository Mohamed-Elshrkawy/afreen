<?php

namespace App\Http\Controllers\Api\website;


use App\Http\Controllers\Controller;
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
        foreach ($request->items as $item) {
            $product=Product::where('id','product_id')->get();
            $price = $product->offer_price * $item['quantity'];
            $product = Product::find($item['product_id']);
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }
        $order->total_price = $price;
        $order->save();

        return response()->json($order->load('items.product'));
    }
}

