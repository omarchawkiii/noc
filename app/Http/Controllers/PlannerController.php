<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Moviescod;
use App\Models\Nocspl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlannerController extends Controller
{
    public function index(Request $request)
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::orderBy('name', 'DESC')->get() ;
        }

        $template = Nocspl::where('is_template',1)->get() ;
        $cpls = null ;

        return view('planner.index', compact('locations'));
    }
    public function get_movies(Request $request)
    {
        $movies = Moviescod::where('location_id',$request->location)->where('status','unlinked')->where('exist_inPos',1)->orderBy('title', 'ASC')->get() ;
    }

}
