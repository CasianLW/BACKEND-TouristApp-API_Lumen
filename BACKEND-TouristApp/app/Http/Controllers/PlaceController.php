<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
        
            $place = Place::findOrFail($id);
           return response()->json($place, 200);
    
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => "Error: Place not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Not Found ! ".$th], 404);
        }
    }

    public function store(Request $request,$id)
    {

        $this->validate($request, [
            'name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'location_id' => 'numeric',
            'visited' => 'boolean',
        ]);
        try {
        
        $place = new Place;
        $place->location_id = $id;
        $place->name = $request->input('name');
        $place->lat = $request->input('lat');
        $place->lng = $request->input('lng');
        // $place->visited = $request->input('visited');
        $place->visited = $request->input('visited', false); 
        $place->save();
        
        return response()->json( $place, 201);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['error' => "Error: ". $th], 422);

    }
    }
    public function show($id)
    {
        try{
        $places = DB::table('places')
                ->where('location_id', $id)
                ->get();
    // return response()->json($places);
    return response()->json($places, 200);

} catch (\Throwable $th) {
    //throw $th;
    return response()->json(['error' => "Error: Not Found ". $th], 404);

}
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'location_id' => 'numeric',
            'visited' => 'required|boolean',
        ]);
        try{
        $place = Place::findOrFail($id);

        $place->location_id = $request->input('location_id', $place->location_id); 
        $place->name = $request->input('name');
        $place->lat = $request->input('lat');
        $place->lng = $request->input('lng');
        $place->visited = $request->input('visited');

        $place->save();
        return response()->json($place, 200);
        
        // return response()->json(($place));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => "Error: Place not found"], 404);
    } catch (\Throwable $e) {
        return response()->json(['error' => "Error: Unprocessable Entity ". $e], 422);
    }
    }

    public function destroy($id)
    {
        try{
        $place = Place::findOrFail($id);
        $place->delete();
        return response()->json(['message' => "Place #$id removed !"], 204);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => "Error: Place not found"], 404);
    } catch (\Throwable $e) {
        return response()->json(['error' => "Error: Unprocessable Entity ". $e], 422);
    }

    }
}
