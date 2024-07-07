<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\news_latter_emails;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Welcome, admin!']);
    }
    public function latterEmail()
    {
        $email = news_latter_emails::all();
        return response()->json($email);
    }
}
