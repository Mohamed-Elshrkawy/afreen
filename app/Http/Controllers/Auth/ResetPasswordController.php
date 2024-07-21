<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;


use App\Notifications\ResetPasswordNotification;
use Ichtrojan\Otp\Otp;


class ResetPasswordController extends Controller
{
    private $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        $user->notify(new ResetPasswordNotification());
        return response()->json(['massage'=>'go to reset password'],200);
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        $otp1=$this->otp->validate($request->email , $request->otp);
        if(!$otp1->status)
        {
            return response()->json(['error'=> $otp1],401);
        }
        $user = User::where('email',$request->email)->first();
        $user->update(['password' => bcrypt($request->password)]);
        return response()->json(['massage'=>'user successfuly reset password'],200);
    }

}
