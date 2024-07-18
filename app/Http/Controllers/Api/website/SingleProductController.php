<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SingleProductController extends Controller
{
    public function index($id)
    {
        $data =Product::find($id);
        $category_id= $data->category_id;
        $related =Product::where('category_id',$category_id);
        
    }
}
