<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature = Feature::all();
        return response()->json([
            'message' => 'feature successfully ',
            'data' => $feature
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {

        $feature=Feature::create([
            'en'=>$request->en,
            'ar'=>$request->ar,
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
        $feature =Feature::find($id);
        return response()->json([
            'message' => 'feature successfully ',
            'data' => $feature
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureRequest $request, string $id)
    {
        $feature = Feature::find($id);

        $feature->update([
            'en'=>$request->en,
            'ar'=>$request->ar,
        ]);
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
        $feature = Feature::find($id);
        if (!$feature) {
            return response()->json([
                'success' => false,
                'message' => 'feature not found'
            ], 404);
        }
        $feature->delete();

        return response()->json([
            'success' => true,
            'message' => 'feature deleted successfully'
        ]);
    }

}
