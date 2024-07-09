<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewLatterEmail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Welcome, admin!']);
    }
    public function latterEmail()
    {
        $email = NewLatterEmail::all();
        return response()->json($email);
    }
}
