<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Coupon;
use App\Models\feature;
use App\Models\Review;
use App\Models\setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Like;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::where('status', 1)->get();
        $category = Category::limit(12)->get();
        $weeklyOffer = Offer::latest()->with('product')->limit(4)->get();
        $lastProduct = Product::latest()->limit(4)->get();
        $recommended = Product::where('is_recommend', true)->limit(4)->get();
        $feature = Feature::limit(4)->get();
        $review = Review::limit(4)->get();
        $setting = Setting::select('logo', 'about_ar', 'about_en','email','phone')->first();

        return response()->json([
            'slider' => $slider,
            'category' => CategoryResource::collection($category),
            'weeklyOffer' => ProductResource::collection($weeklyOffer),
            'lastProduct' => ProductResource::collection($lastProduct),
            'recommended' => ProductResource::collection($recommended),
            'feature' => $feature,
            'review' => $review,
            'setting' => $setting,
        ]);
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

    public function showdiscounts()
    {
        $discounts = Coupon::paginate(3);
        return response()->json(['discount' => $discounts]);
    }

    public function search(Request $request)
    {
        $data = Product::whereTranslationLike('name', 'LIKE', '%' . $request->input('query') . '%')->get();
        return response()->json($data);
    }

    public function viewAllWeeklyOffer()
    {
        $weeklyOffer = Offer::with('product')->paginate(12);
        return ProductResource::collection($weeklyOffer);
    }
}
