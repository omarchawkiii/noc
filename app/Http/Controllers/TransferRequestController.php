<?php

namespace App\Http\Controllers;

use App\Models\CinemaLocation;
use App\Models\InventoryCategory;
use App\Models\Part;
use App\Models\StorageLocation;
use App\Models\TransferRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferRequestController extends Controller
{
    public function index(Request $request)
    {
        $transfer_requests =  TransferRequest::all();
        $categories = InventoryCategory::all() ;
        $storage_locations = StorageLocation::all() ;
        $cinema_locations = CinemaLocation::all() ;
        return view('transfer_requests.index', compact('transfer_requests','categories','storage_locations','cinema_locations'));
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

    public function get_transfer_requests(Request $request)
    {
        $transfer_requests = TransferRequest::with(['user','storageLocation','part','CinemaLocation','approvedBy'])->get();
        return Response()->json(compact('transfer_requests'));
    }

    public function store(Request $request)
    {
        $transfer_request = TransferRequest::create([
            'part_id' => $request->part_number ,
            'serials' => $request->serials ,
            'storage_location_id' => $request->storage_id ,
            'cinema_location_id' => $request->cinema_location_id ,
            'user_id' => Auth::user()->id ,
            'reason'  => $request->reason,
        ]);
            if($transfer_request)
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
       if(TransferRequest::find($id)->delete())
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
            $transfer_request = TransferRequest::with('InventoryCategory')->find($id);
        return Response()->json(compact('part'));
    }

    public function approuve(Request $request)
    {
            $transfer_request = TransferRequest::find($request->id);
            $transfer_request->update([
            'approved_by_id' => Auth::user()->id ,
            'approved_date' => Carbon::now() ,
        ]);
            if($transfer_request)
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }

    }
}
