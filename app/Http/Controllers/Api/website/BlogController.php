<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blog =blog::paginate(6);
        return response()->json($blog);
    }
    public function readMore($id)
    {
        $blog =Blog::find($id);
        return response()->json($blog);
    }

}
