<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\Website\ProductResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function count(){
        $count=Cart::where('user_id',Auth::user()->id)->count();
        return response()->json($count);

    }
    public function index()
    {
        $cart = Auth::user()->cart()->with('items.product')->first();
        return response()->json($cart);
    }


    public function add(CartRequest $request)
    {
        $cart = Auth::user()->cart()->firstOrCreate();
        $product = Product::find($request->product_id);

        $cartItem = $cart->items()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return response()->json([$cartItem,ProductResource::collection($product)]);
    }

    public function remove($itemId)
    {
        $cart = Auth::user()->cart()->first();
        $cartItem = $cart->items()->findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['message' => 'Item removed successfully']);
    }
}
