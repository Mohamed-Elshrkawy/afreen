<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Slider = Slider::all();
        return response()->json($Slider);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $Slider = Slider::create([
                'status' => $request->status,

            ]);
            return response()->json([
                'success' => true,
                'data' => $Slider
            ], 201);

        }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Slider = Slider::find($id);
        if(!$Slider){
            return response()->json([
                'success' => false,
                'message' => 'Slider not found'
            ], 404);
        }
        return response()->json($Slider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $slider=Slider::find($id);
        $slider->update([
            'status' => $request->status,
        ]);

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
        $Slider = Slider::find($id);
        if (!$Slider) {
            return response()->json([
                'success' => false,
                'message' => 'Slider not found'
            ], 404);
        }

        if ($Slider->image) {
            Storage::disk('public')->delete($Slider->image);
        }

        $Slider->delete();

        return response()->json([
            'success' => true,
            'message' => 'Slider deleted successfully'
        ]);
    }
}
