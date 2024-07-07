<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\slider;
use Illuminate\Support\Facades\Storage;
use Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = slider::all();
        return response()->json($slider);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 400);
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('sliders', 'public');
            }
            $slider = Slider::create([
                'image' => $imagePath,
                'status' => $request->status,
            ]);
            return response()->json([
                'success' => true,
                'data' => $slider
            ], 201);
        }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slider = slider::find($id);
        if(!$slider){
            return response()->json([
                'success' => false,
                'message' => 'Slider not found'
            ], 404);
        }
        return response()->json($slider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $slider = Slider::find($id);
        if (!$slider) {
            return response()->json([
                'success' => false,
                'message' => 'Slider not found'
            ], 404);
        }

        if ($request->hasFile('image')) {

            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('sliders', 'public');
            $slider->image = $imagePath;
        }

        $slider->status = $request->status;
        $slider->save();

        return response()->json([
            'success' => true,
            'data' => $slider
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return response()->json([
                'success' => false,
                'message' => 'Slider not found'
            ], 404);
        }

        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return response()->json([
            'success' => true,
            'message' => 'Slider deleted successfully'
        ]);
    }
}
