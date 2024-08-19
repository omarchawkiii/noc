<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers =  Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function get_suppliers(Request $request)
    {
        $suppliers = Supplier::all();
        return Response()->json(compact('suppliers'));
    }

    public function store(Request $request)
    {
       $supplier = Supplier::create([
            'company_name'=> $request->company_name ,
            'contact_name'=> $request->contact_name ,
            'email'=> $request->email ,
        ]);
        if($supplier)
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
       if(Supplier::find($id)->delete())
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
        $supplier = Supplier::find($id);
        return Response()->json(compact('supplier'));
    }

    public function update(Request $request)
    {

        $supplier = Supplier::find($request->id);
        $supplier->update([
            'company_name'=> $request->company_name ,
            'contact_name'=> $request->contact_name ,
            'email'=> $request->email ,
        ]);
        if($supplier)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
