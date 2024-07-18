<?php

namespace App\Http\Controllers\Api\website;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\OurTeam;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutus=About::all();
        $service=Service::limit(6)->get();
        $ourTeam=OurTeam::limit(2)->get();

        return response()->json(['About Us'=>$aboutus ,'Service'=>$service ,'Our Team'=>$ourTeam]);
    }
    public function viewAllMembers()
    {
        $ourTeam =OurTeam::paginate(12);
        return response()->json($ourTeam);
    }
}
