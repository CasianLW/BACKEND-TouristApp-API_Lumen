<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Str;


class LocationController extends Controller
{
    public function index()
    {
        try {

       $locations = Location::all();
    //    return response()->json($locations);
       return response()->json($locations, 200);

    } catch (\Throwable $th) {
        return response()->json(['error' => "Error: ".$th], 404);
    }
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        try {

        $location = new Location();

        $location->name =$request->input('name');

        $location->slug =Str::slug($location->name, '-') ;
        $slug = Str::slug($location->name, '-');
        // Check if the slug is unique
        if (Location::where('slug', $slug)->exists()) {
            $i = 1;

            // Append incremental numbers to the slug until a unique one is found
            while (Location::where('slug', $slug . '-' . $i)->exists()) {
                $i++;
           }
            $slug .= '-' . $i;
        }

        $location->slug = $slug;
        $location->lat =$request->input('lat');
        $location->lng =$request->input('lng');

        $location->save();
        
        // return response()->json(($location));
       return response()->json($location, 201);
    } catch (\Throwable $th) {
        return response()->json(['error' => "Error: ".$th], 404);
    }

    }


    public function show($id)
    {
        try {
        
        $location = Location::findOrFail($id);
    //    return response()->json($location);
       return response()->json($location, 200);

    }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => "Error: Place not found"], 404);
    } catch (\Throwable $th) {
        return response()->json(['error' => "Not Found ! ".$th], 404);
    }
    }


    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'name'=> 'required',
            'slug'=> 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        try {
            //code...
        
        $location = Location::findOrFail($id);

        $location->name =$request->input('name');
        $location->slug =$request->input('slug');
        $location->lat =$request->input('lat');
        $location->lng =$request->input('lng');

        $location->save();
        
        // return response()->json(($location));
        return response()->json($location, 200);

    }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => "Error: Place not found"], 404);
    } catch (\Throwable $th) {
        return response()->json(['error' => "Error: Unprocessable Entity  ".$th], 422);
    }
    }

    public function destroy($id)
    {
        try {
        $location = Location::findOrFail($id);
        $location->delete();
    //    return response()->json("Location #$id removed !");
       return response()->json(['message' => "Location #$id removed !"], 204);

    }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => "Error: Place not found"], 404);
    } catch (\Throwable $th) {
        return response()->json(['error' => "Error: Not Found ".$th], 404);
    }
    }
}
