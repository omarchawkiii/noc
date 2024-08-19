<?php

namespace App\Http\Controllers;

use App\Models\CinemaLocation;
use Illuminate\Http\Request;

class CinemaLocationController extends Controller
{
    public function index(Request $request)
    {
        $cinema_locations =  CinemaLocation::all();
        return view('cinema_locations.index', compact('cinema_locations'));
    }

    public function get_cinema_locations(Request $request)
    {
        $cinema_locations = CinemaLocation::all();
        return Response()->json(compact('cinema_locations'));
    }

    public function store(Request $request)
    {
       $cinema_location = CinemaLocation::create([
            'name'=> $request->name ,
            'address'=> $request->address ,
            'contact'=> $request->contact ,
            'email'=> $request->email ,
        ]);
        if($cinema_location)
        {
            echo "Success" ;
        }
        else
        {
            echo "Faild" ;
        }
    }
    public function destroy($id)
    {
       if(CinemaLocation::find($id)->delete())
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }
    }
    public function show($id)
    {
        $cinema_location = CinemaLocation::find($id);
        return Response()->json(compact('cinema_location'));
    }

    public function update(Request $request)
    {
        $cinema_location = CinemaLocation::find($request->id);
        $cinema_location->update([
            'name'=> $request->name ,
            'address'=> $request->address ,
            'contact'=> $request->contact ,
            'email'=> $request->email ,
        ]);
        if($cinema_location)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
