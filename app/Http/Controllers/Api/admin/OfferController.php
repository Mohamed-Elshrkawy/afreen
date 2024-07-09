<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\offer;
use Illuminate\Http\Request;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offer = offer::all();
        return response()->json($offer , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer=offer::create([
            'discount_perecentage'=>$request->discount,
            'product_id'=>$request->product_id
        ]);
        return response()->json([
            'message' => 'offer successfully create',
            'data' => $offer
        ], 201);    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = offer::find($id);

        return response()->json([
            'message' => 'offer successfully select',
            'data' => $offer
        ], 201);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $offer = offer::find($id);
        $offer ->discount_perecentage=$request->discount;
        $offer->save();
        return response()->json([
            'message' => 'offer successfully update',
            'data' => $offer
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = offer::find($id);
        $offer ->delete();
        return response()->json(null, 204);
    }
}
