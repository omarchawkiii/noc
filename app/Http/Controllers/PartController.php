<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $parts =  Part::with('InventoryCategory')->get();
        //dd($parts) ;
        $categories = InventoryCategory::all() ;
        return view('parts.index', compact('parts','categories'));
    }

    public function get_parts(Request $request)
    {
        $parts = Part::with('InventoryCategory')->get();

        return Response()->json(compact('parts'));
    }

    public function store(Request $request)
    {

       $part = Part::create([
            'part_number'=> $request->part_number ,
            'part_description'=> $request->part_description ,
            'serialized'=> $request->serialized ,
            'inventory_category_id'=> $request->inventory_category_id ,
        ]);
        if($part)
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
       if(Part::find($id)->delete())
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
        $part = Part::with('InventoryCategory')->find($id);

        return Response()->json(compact('part'));
    }

    public function update(Request $request)
    {
        $part = Part::find($request->id);
        $part->update([
            'part_number'=> $request->part_number ,
            'part_description'=> $request->part_description ,
            'serialized'=> $request->serialized ,
            'inventory_category_id'=> $request->inventory_category_id ,
        ]);
        if($part)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
