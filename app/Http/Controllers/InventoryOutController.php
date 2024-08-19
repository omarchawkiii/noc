<?php

namespace App\Http\Controllers;

use App\Models\CinemaLocation;
use App\Models\InventoryCategory;
use App\Models\InventoryOut;
use App\Models\Part;
use App\Models\StorageLocation;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryOutController extends Controller
{
    public function index(Request $request)
    {
        $inventories_out =  InventoryOut::all();
        $categories = InventoryCategory::all() ;
        $storage_locations = StorageLocation::all() ;
        $cinema_locations = CinemaLocation::all() ;
        return view('inventories_out.index', compact('inventories_out','categories','storage_locations','cinema_locations'));
    }

    public function get_part_from_category(Request $request)
    {
        $parts = Part::where('inventory_category_id',$request->inventory_category_id)->get();
        return Response()->json(compact('parts'));
    }

    public function get_description_from_part(Request $request)
    {
        $part = Part::find($request->part_id);
        return Response()->json(compact('part'));
    }

    public function get_inventories_out(Request $request)
    {
        $inventories_out = InventoryOut::with(['user','storageLocation','part','CinemaLocation','approvedBy'])->get();

        return Response()->json(compact('inventories_out'));
    }

    public function store(Request $request)
    {
       $inventory_out = InventoryOut::create([
            'part_id' => $request->part_number ,
            'quantity' => $request->quantity ,
            'serials' => $request->serials ,
            'storage_location_id' => $request->storage_id ,
            'cinema_location_id' => $request->cinema_location_id ,

            'user_id' => Auth::user()->id ,
            'date_out' => Carbon::now() ,
        ]);
        if($inventory_out)
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
       if(InventoryOut::find($id)->delete())
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
        $inventory_out = InventoryOut::with('InventoryCategory')->find($id);

        return Response()->json(compact('part'));
    }

    public function approuve(Request $request)
    {
        $inventory_out = InventoryOut::find($request->id);
        $inventory_out->update([
            'approved_by_id' => Auth::user()->id ,
            'approved_date' => Carbon::now() ,
        ]);
        if($inventory_out)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
