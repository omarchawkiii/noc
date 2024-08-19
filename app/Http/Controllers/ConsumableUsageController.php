<?php

namespace App\Http\Controllers;

use App\Models\CinemaLocation;
use App\Models\ConsumableUsage;
use App\Models\InventoryCategory;
use App\Models\Part;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumableUsageController extends Controller
{
    public function index(Request $request)
    {
        $consumable_usages =  ConsumableUsage::all();
        $categories = InventoryCategory::all() ;
        $cinema_locations = CinemaLocation::all() ;
        return view('consumable_usages.index', compact('consumable_usages','categories','cinema_locations'));
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

    public function get_consumable_usages(Request $request)
    {
        $consumable_usages = ConsumableUsage::with(['user','storageLocation','part','CinemaLocation','approvedBy'])->get();

        return Response()->json(compact('consumable_usages'));
    }

    public function store(Request $request)
    {
       $consumable_usage = ConsumableUsage::create([
            'part_id' => $request->part_number ,
            'quantity' => $request->quantity ,
            'serials' => $request->serials ,
            'storage_location_id' => $request->storage_id ,
            'cinema_location_id' => $request->cinema_location_id ,

            'user_id' => Auth::user()->id ,
            'date_out' => Carbon::now() ,
        ]);
        if($consumable_usage)
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
       if(ConsumableUsage::find($id)->delete())
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
        $consumable_usage = ConsumableUsage::with('InventoryCategory')->find($id);

        return Response()->json(compact('part'));
    }

    public function approuve(Request $request)
    {
        $consumable_usage = ConsumableUsage::find($request->id);
        $consumable_usage->update([
            'approved_by_id' => Auth::user()->id ,
            'approved_date' => Carbon::now() ,
        ]);
        if($consumable_usage)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
