<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Like;
use App\Models\Offer;
use App\Models\discount;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        return response()->json([
            'categories' => $categories
        ]);
    }
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create([

            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product added to cart successfully', 'cart' => $cart]);
    }

    public function likeProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $like = Like::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product liked successfully', 'like' => $like]);
    }

    public function showOffers()
    {
        $offers = Offer::all();
        return response()->json(['offers' => $offers]);
    }

    public function showNotifications()
    {
        $notifications = Notification::where('user_id', Auth::id())->get();
        return response()->json(['notifications' => $notifications]);
    }
    public function showdiscounts()
    {
        $discounts = discount::all();
        return response()->json(['discount' => $discounts]);
    }
}
