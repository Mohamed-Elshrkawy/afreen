<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\setting;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $setting=setting::select('address','Email','phone');
        return response()->json($setting);
    }
    public function send(Request $request)
    {
        $send=Complaint::create($request->all());
        return response()->json(['message'=>'The message sent succefuly']);
    }
}
