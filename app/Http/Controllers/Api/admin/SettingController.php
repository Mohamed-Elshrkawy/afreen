<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;

class SettingController extends Controller
{
    public function index()
    {
        $setting=Setting::all();
        return response()->json($setting);
    }
    public function store(SettingRequest $request)
    {
        $setting = Setting::create([
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
    $setting = Setting::find($id);
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
public function update(SettingRequest $request, $id)
{
    $setting = Setting::find($id);
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
    $setting = Setting::find($id);
    if (!$setting) {
        return response()->json([
            'success' => false,
            'message' => 'Setting not found'
        ], 404);
    }

    $setting->delete();

    return response()->json([
        'success' => true,
        'message' => 'Setting deleted successfully'
    ]);
}
}
