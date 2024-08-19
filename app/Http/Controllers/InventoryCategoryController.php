<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    public function index(Request $request)
    {
        $inventory_categories = InventoryCategory::all();
        $locations =Location::all() ;
        return view('inventory_categories.index', compact('inventory_categories','locations'));
    }

    public function get_categories(Request $request)
    {
        $inventory_categories = InventoryCategory::all();
        return Response()->json(compact('inventory_categories'));
    }

    public function store(Request $request)
    {
       $inventory_category = InventoryCategory::create([
            'name' => $request->name ,
        ]);
        if($inventory_category)
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
       if(InventoryCategory::find($id)->delete())
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
        $inventory_category = InventoryCategory::find($id);
        return Response()->json(compact('inventory_category'));
    }

    public function update(Request $request)
    {
        $inventory_category = InventoryCategory::find($request->id);
        $inventory_category->update([
            'name' => $request->name ,
        ]);
        if($inventory_category)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }

}
