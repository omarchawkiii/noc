<?php

namespace App\Http\Controllers;

use App\Models\StorageLocation;
use Illuminate\Http\Request;

class StorageLocationController extends Controller
{
    public function index(Request $request)
    {
        $storage_locations =  StorageLocation::all();
        return view('storage_locations.index', compact('storage_locations'));
    }

    public function get_storage_locations(Request $request)
    {
        $storage_locations = StorageLocation::all();
        return Response()->json(compact('storage_locations'));
    }

    public function store(Request $request)
    {
       $storage_location = StorageLocation::create([
            'name'=> $request->name ,
            'address'=> $request->address ,
            'contact'=> $request->contact ,
            'email'=> $request->email ,
        ]);
        if($storage_location)
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
       if(StorageLocation::find($id)->delete())
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
        $storage_location = StorageLocation::find($id);
        return Response()->json(compact('storage_location'));
    }

    public function update(Request $request)
    {
        $storage_location = StorageLocation::find($request->id);
        $storage_location->update([
            'name'=> $request->name ,
            'address'=> $request->address ,
            'contact'=> $request->contact ,
            'email'=> $request->email ,
        ]);
        if($storage_location)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
