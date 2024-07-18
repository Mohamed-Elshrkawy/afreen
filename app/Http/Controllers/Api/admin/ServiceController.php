<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $service=Service::all();
        return response()->json($service);
    }

    public function store(ServiceRequest $request)
    {
        $service =Service::create($request->all());
        return response()->json(['message' => 'service created successfully','data'=>$service],200);
    }

    public function show(Service $service)
    {
        return response()->json($service);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        return response()->json(['message' => 'service update successfully','data'=>$service],200);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'service delete successfully']);
    }
}
