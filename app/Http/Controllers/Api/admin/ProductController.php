<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Error;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\product_image;
use App\Models\product_color;
use App\Models\product_size;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = product::all();
        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'en.name'=>'required|string|max:255',
            'ar.name'=>'required|string|max:255',
            'en.description'=>'required|string|max:255',
            'ar.description'=>'required|string|max:255',
            'price'=>'required',
            'code'=>'required',
            'category_id'=>'required|integer',
            'size'=>'nullable|array|',
            'color'=>'nullable|array|',
            'images' => 'require|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product =product::create([
            'en'=>$request->en,
            'ar'=>$request->ar,
            'price'=>$request->price,
            'code'=>$request->code,
            'category_id'=>$request->category_id
        ]);

        $id=$product->id;
        $colors = $request->input('color');
        if ($colors) {
            $savedColors = [];
            foreach ($colors as $color) {
                $savedColors[] = Product_Color::create([
                    'color' => $color,
                    'product_id' => $id
                ]);
            }
        }

        $images = $request->images;
        if ($images) {
            $imagespath = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images');
                $imagespath[] = $path;
            }
            foreach ($imagespath as $imagepath) {
                Product_image::create([
                    'product_id' => $product->id,
                    'color_id' => $colors->id,
                    'image' => $imagepath,
                ]);
            }
        }

        $sizes = $request->size;
        if ($sizes) {
            foreach ($sizes as $size) {
                Product_Size::create([
                    'size' => $size,
                    'product_id' => $product->id,
                ]);
            }
        }
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product= product::find($id);
        if(!$product){
            return response()->json("not found");
        }
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product =product::find($id);
        $validator = Validator::make($request->all(), [
            'en.name'=>'nullable|string|max:255',
            'ar.name'=>'nullable|string|max:255',
            'en.description'=>'nullable|string|max:255',
            'ar.description'=>'nullable|string|max:255',
            'price'=>'nullable',
            'code'=>'nullable',
            'category_id'=>'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product =product::update([
            'en'=>$request->en,
            'ar'=>$request->ar,
            'price'=>$request->price,
            'code'=>$request->code,
            'category_id'=>$request->category_id
        ]);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product= product::find($id);
        if(!$product){
            return response()->json("not found");
        }
        $product->delete();

        return response()->json(null,204);
    }
    public function changeRecommend(Request $request, string $id)
    {
        $product = product::find($id);
        $product->is_recommend =$request->recommend;
        $product->save();
        return response()->json([
            'message' => 'recommmend change successfully ',
            'data' => $product
        ], 201);
    }
}
