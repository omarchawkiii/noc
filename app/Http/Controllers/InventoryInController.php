<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\InventoryIn;
use App\Models\Part;
use App\Models\StorageLocation;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryInController extends Controller
{
    public function index(Request $request)
    {
        $inventories_in =  InventoryIn::all();
        $categories = InventoryCategory::all() ;
        $storage_locations = StorageLocation::all() ;
        $suppliers = Supplier::all() ;
        return view('inventories_in.index', compact('inventories_in','categories','storage_locations','suppliers'));
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
    public function get_inventories_in(Request $request)
    {
        $inventories_in = InventoryIn::with(['InventoryCategory','supplier','user','storageLocation','part','part.inventoryCategory'])->get();

        return Response()->json(compact('inventories_in'));
    }

    public function store(Request $request)
    {
       $inventory_in = InventoryIn::create([

            'inventory_category_id' => $request->inventory_category_id ,
            'part_id' => $request->part_number ,
            'quantity' => $request->quantity ,
            'serials' => $request->serials ,
            'supplier_id' => $request->supplier_id ,
            'po_reference' => $request->po_reference ,
            'do_reference' => $request->do_reference ,
            'storage_location_id' => $request->storage_id ,
            'user_id' => Auth::user()->id ,
        ]);
        if($inventory_in)
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
       if(InventoryIn::find($id)->delete())
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
        $inventory_in = InventoryIn::with('InventoryCategory')->find($id);

        return Response()->json(compact('part'));
    }

    public function update(Request $request)
    {
        $inventory_in = InventoryIn::find($request->id);
        $inventory_in->update([
            'part_number'=> $request->part_number ,
            'part_description'=> $request->part_description ,
            'serialized'=> $request->serialized ,
            'inventory_category_id'=> $request->inventory_category_id ,
        ]);
        if($inventory_in)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
