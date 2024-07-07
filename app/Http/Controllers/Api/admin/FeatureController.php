<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\features;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature = features::all();
        return response()->json([
            'message' => 'feature successfully ',
            'data' => $feature
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('features', 'public');
        }
        $feature=features::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$imagePath
        ]);
        return response()->json([
            'message' => 'feature created successfully ',
            'data' => $feature
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feature =features::find($id);
        return response()->json([
            'message' => 'feature successfully ',
            'data' => $feature
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature = features::find($id);
        if ($request->hasFile('image')) {

            if ($feature->image) {
                Storage::disk('public')->delete($feature->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('features', 'public');
            $feature->image = $imagePath;
        }

        $feature->status = $request->status;
        $feature->save();

        return response()->json([
            'success' => true,
            'data' => $feature
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = features::find($id);
        if (!$feature) {
            return response()->json([
                'success' => false,
                'message' => 'feature not found'
            ], 404);
        }

        if ($feature->image) {
            Storage::disk('public')->delete($feature->image);
        }

        $feature->delete();

        return response()->json([
            'success' => true,
            'message' => 'feature deleted successfully'
        ]);
    }
    
}
