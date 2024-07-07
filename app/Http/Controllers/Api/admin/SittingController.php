<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;

class SittingController extends Controller
{
    public function index()
    {
        $setting=settings::all();
        return response()->json($setting);
    }
    public function store(Request $request)
    {


        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imagePath = $image->store('logo', 'public');
        }
        $setting = settings::create([
            'logo' => $imagePath,
            'about_ar' => $request->about_ar,
            'about_en' => $request->about_en,
        ]);
        return response()->json([
            'success' => true,
            'data' => $setting,
        ], 201);
    }
/**
 * Display the specified resource.
 */
public function show(string $id)
{
    $setting = settings::find($id);
    if(!$setting){
        return response()->json([
            'success' => false,
            'message' => 'setting not found'
        ], 404);
    }
    return response()->json($setting);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $setting = Settings::find($id);
    if (!$setting) {
        return response()->json([
            'success' => false,
            'message' => 'setting not found'
        ], 404);
    }

    if ($request->hasFile('logo')) {

        if ($setting->logo) {
            Storage::disk('public')->delete($setting->logo);
        }

        $image = $request->file('logo');
        $imagePath = $image->store('logo', 'public');
        $setting->logo = $imagePath;
    }

    $setting->about_ar = $request->about_ar ;
    $setting->about_en = $request->about_en ;
    $setting->save();

    return response()->json([
        'success' => true,
        'data' => $setting
    ]);
}
/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    $setting = Settings::find($id);
    if (!$setting) {
        return response()->json([
            'success' => false,
            'message' => 'Setting not found'
        ], 404);
    }

    if ($setting->logo) {
        Storage::disk('public')->delete($setting->logo);
    }

    $setting->delete();

    return response()->json([
        'success' => true,
        'message' => 'Setting deleted successfully'
    ]);
}
}
