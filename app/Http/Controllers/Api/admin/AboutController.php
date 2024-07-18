<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature = About::all();
        return response()->json([
            'message' => 'feature successfully ',
            'data' => $feature
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        // dd($request->all());
        $about = About::create([
            'en'=>$request->en,
            'ar'=>$request->ar,
        ]);
        return response()->json($about);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = About::find($id);
        return response()->json($about);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::find($id);
        $about->update([
            'en'=>$request->en,
            'ar'=>$request->ar,
        ]);
        return response()->json($about);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::find($id);
        $about->delete();
        return response()->json(null, 204);
    }
}
