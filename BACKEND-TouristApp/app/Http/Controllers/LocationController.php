<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
       $locations = Location::all();
       return response()->json($locations);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'slug'=> 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);
        $location = new Location();

        $location->name =$request->input('name');
        $location->slug =$request->input('slug');
        $location->lat =$request->input('lat');
        $location->lng =$request->input('lng');

        $location->save();
        
        return response()->json(($location));
    }


    public function show($id)
    {
        $location = Location::find($id);
       return response()->json($location);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=> 'required',
            'slug'=> 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);
        $location = Location::find($id);

        $location->name =$request->input('name');
        $location->slug =$request->input('slug');
        $location->lat =$request->input('lat');
        $location->lng =$request->input('lng');

        $location->save();
        
        return response()->json(($location));
    }

    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
       return response()->json("Location #$id removed !");
    }
}
