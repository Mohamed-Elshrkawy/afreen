<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\OrderResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Order;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::user()->profile()->get();
        return response()->json($data);
    }
    public function create(Request $request)
    {
        $data =Profile::updateOrCreate([
            'phone'=>$request->phone,
            'Country_code'=>$request->country_code,
            'user_id'=>Auth::user()->id
        ]);

        $user=Auth::user();
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        return response()->json([$data,$user]);
    }
    public function current()
    {
        $id=Auth::user()->id;
        $order=Order::whereNotIn('status',['delivared','canceled'])->where('user_id',$id)->get();
        return OrderResource::collection($order);

    }
    public function completed()
    {
        $id=Auth::user()->id;
        $order=Order::where('status','delivared')->where('user_id',$id)->get();
        return OrderResource::collection($order);

    }
    public function canceled()
    {
        $id=Auth::user()->id;
        $order=Order::whereNotIn('status','canceled')->where('user_id',$id)->get();
        return OrderResource::collection($order);

    }
    public function myWallet()
    {
        Auth::user()->wallet()->create();
        $wallet = Auth::user()->wallet;
        $transactions = $wallet->transactions()->paginate(10);

        return response()->json([$wallet,$transactions]);
    }
    public function myfavorite()
    {
        $data = Auth::user()->like;
        $product=$data->product()->paginate(10);
        return ProductResource::collection($product);
    }
    
}
