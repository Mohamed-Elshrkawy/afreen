<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review =review::all();
        return response()->json($review);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('review', 'public');
        }
        $review =review::create([
            'name'=>$request->name,
            'review'=>$request->review,
            'image'=>$request->image
        ]);

        return response()->json([
            'success' => true,
            'data' => $review
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review=review::find($id);
        return response()->json([
            'success' => true,
            'data' => $review
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = review::find($id);
        if ($request->hasFile('image')) {

            if ($review->image) {
                Storage::disk('public')->delete($review->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('review', 'public');
            $review->image = $imagePath;
        }
        $review->name = $request->name;
        $review->review =$request->review;
        $review -> save();
        return response()->json([
            'success' => true,
            'data' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = review::find($id);
        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'review not found'
            ], 404);
        }

        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'review deleted successfully'
        ]);
    }
}
