<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OurTeamRequest;
use App\Models\OurTeam;


class OurTeamController extends Controller
{
    public function index()
    {
        $ourTeam=OurTeam::paginate(9);
        return response()->json($ourTeam);
    }


    public function store(OurTeamRequest $request)
    {
        $ourTeam = OurTeam::create(
            $request->only(['name','job'])
        );
        return response()->json($ourTeam);
    }


    public function show(OurTeam $ourTeam)
    {
        return response()->json($ourTeam);
    }


    public function update(OurTeamRequest $request, OurTeam $ourTeam)
    {
        $ourTeam->update($request->only(['name','job']));
        return response()->json($ourTeam);
    }


    public function destroy(OurTeam $ourTeam)
    {
        $ourTeam->delete();
    }
}
