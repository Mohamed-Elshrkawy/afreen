<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Storage;

use Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'en.name'=>'required|string|max:255',
            'ar.name'=>'required|string|max:255',
            'en.description'=>'nullable|string|max:255',
            'ar.description'=>'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('catigories', 'public');
        }

        $category = Category::create([
            'en'=>$request->en,
            'ar'=>$request->ar,
            'image'=>$imagePath,

        ]);

        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ar.name' => 'nullable|string|max:255',
            'en.name' => 'nullable|string|max:255',
            'ar.description' => 'nullable|string',
            'en.description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }


        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        if ($request->hasFile('image')) {

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('categories', 'public');
            $category->image = $imagePath;
        }


        return new CategoryResource($category);

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json(null, 204);
        }
    
}
