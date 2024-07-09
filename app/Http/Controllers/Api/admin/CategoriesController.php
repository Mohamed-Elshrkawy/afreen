<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

use Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'en'=>$request->en,
            'ar'=>$request->ar,
        ]);
        return new CategoryResource($category);
    }
    public function show($id)
    {
        $category = Category::find($id);
        return new CategoryResource($category);
    }
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->update([
            'en'=>$request->en,
            'ar'=>$request->ar,
        ]);
        return new CategoryResource($category);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(null, 204);
        }
}
