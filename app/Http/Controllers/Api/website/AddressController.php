<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $address=Address::all();
        return response()->json($address);
    }

    public function store(Request $request)
    {
        $address =Address::create($request->all());
        return response()->json(['message' => 'service created successfully','data'=>$address],200);
    }

    public function show(Address $address)
    {
        return response()->json($address);
    }

    public function update(Request $request, Address $address)
    {
        $address->update($request->all());
        return response()->json(['message' => 'service update successfully','data'=>$address],200);
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return response()->json(['message' => 'service delete successfully']);
    }
}
