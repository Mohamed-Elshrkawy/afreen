<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return ProductResource::collection($product);
    }
    public function store(ProductRequest $request)
    {
        $product =Product::create([
            'en'=>$request->en,
            'ar'=>$request->ar,
            'price'=>$request->price,
            'code'=>$request->code,
            'category_id'=>$request->category_id,
            'offer_id'=>$request->offer_id

        ]);
        $product->total_price = $request->price + $product->offer_price;
        $product->save();

        return new ProductResource($product);
    }
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, $id)
    {
        $product=Product::find($id);
        $product->update([
            'en'=>$request->en,
            'ar'=>$request->ar,
            'price'=>$request->price,
            'code'=>$request->code,
            'category_id'=>$request->category_id
        ]);
        if($request->offer_id)
        {
            $product->offer_price=$product->price*((100-$product->offer->discount_perecentage)/100);
            $product->total_price = $request->price + $product->offer_price;
            $product->save();
        }

        return response()->json($product);
    }
    public function destroy(string $id)
    {
        $product= Product::find($id);
        if(!$product){
            return response()->json("not found");
        }
        $product->delete();

        return response()->json(null,204);
    }
    public function changeRecommend(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->is_recommend =$request->recommend;
        $product->save();
        return response()->json([
            'message' => 'recommmend change successfully ',
            'data' => $product
        ], 201);
    }
}
