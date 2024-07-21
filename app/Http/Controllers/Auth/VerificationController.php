<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerficationRequest;
use App\Models\User;
use Ichtrojan\Otp\Otp;


class VerificationController extends Controller
{
    private $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function emailVerification(VerficationRequest $request)
    {
        $otp1=$this->otp->validate($request->email , $request->otp);
        if(!$otp1->status)
        {
            return response()->json(['error'=> $otp1],401);
        }
        $user = User::where('email',$request->email)->first();
        $user->update(['email_verified_at'=> now()]);
        return response()->json([
            'message' => 'User successfully verificated email',
        ], 201);
    }
}
