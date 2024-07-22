<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Moviescod;
use App\Models\Nocspl;
use App\Models\Planner;
use App\Models\Rule;
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

        $templates = Nocspl::where('is_template',1)->get() ;
        $cpls = null ;

        $plans = Planner::with('location')->get() ;

        return view('planner.index', compact('locations','templates','plans'));
    }
    public function get_plans()
    {
        /*$plans = Planner::
         leftJoin('moviescods', 'planners.movies_id', '=', 'moviescods.id')
        ->leftJoin('locations', 'planners.location_id', '=', 'locations.id')
        ->orderBy('planners.id', 'DESC')
        ->select('locations.name as location_name','planners.*','moviescods.title as movie_title')

        ->get() ;*/

        $plans = Planner::with('rules')
        //->leftJoin('moviescods', 'rules.movies_id', '=', 'moviescods.id')
        ->leftJoin('rules', 'planners.id', '=', 'rules.planner_id') // Jointure avec la table rules
        ->leftJoin('moviescods', 'rules.movies_id', '=', 'moviescods.id')

        ->leftJoin('locations', 'rules.location_id', '=', 'locations.id')
        ->leftJoin('cpls', 'planners.cpl_uuid', '=', 'cpls.uuid')
        ->orderBy('planners.id', 'DESC')
        ->groupBy('planners.id')
        ->select('locations.name as location_name','planners.*','moviescods.title as movie_title','cpls.contentTitleText as cpls_name')
        ->get() ;

        return Response()->json(compact('plans'));
    }
    public function get_movies(Request $request)
    {
        $movies = Moviescod::where('location_id',$request->location)->where('status','unlinked')->where('exist_inPos',1)->orderBy('title', 'ASC')->get() ;
    }

    public function get_palnner_form_data(Request $request)
    {
        $cpls = Cpl::where('location_id',$request->location)
            ->groupBy('uuid')
            ->orderBy('contentTitleText', 'ASC')
            ->get() ;

        $movies = Moviescod::where('location_id',$request->location)->where('status','unlinked')->where('exist_inPos',1)->orderBy('title', 'ASC')->get() ;
        return Response()->json(compact('cpls','movies'));
    }

    public function store(Request $request)
    {

        $plan = Planner::create([
            'name'=> $request->name,
            'cpl_uuid'=> $request->cpl_uuid,
            'date_start'=> $request->date_start,
            'date_end'=> $request->date_end,
            'location_id'=> $request->location_id,
            'screen_type'=> $request->screen_type,
            'movies_id'=> $request->movies_id,
            'spl_uuid'=> null,
            'template_position'=> $request->template_position,
            'position'=> $request->position,
            'marker'=> $request->marker,
            'priority'=> $request->priority,
            'feature'=> $request->feature,
        ]);
        if($plan)
        {
            echo "success" ;
        }
        else
        {
            echo "faild" ;
        }

    }

    public function rule_store(Request $request)
    {

        $rule = Rule::create([
            'date_start'=> $request->date_start,
            'date_end'=> $request->date_end,
            'location_id'=> $request->location_id,
            'target_screen_type'=> $request->target_screen_type,
            'movies_id'=> $request->movies_id,
            'template_selection'=> $request->template_selection,
            'marker'=> $request->marker,
            'priority'=> $request->priority,
            'planner_id' => $request->planner_id,
        ]);
        if($rule)
        {
            echo "success" ;
        }
        else
        {
            echo "faild" ;
        }

    }



    public function get_templates()
    {
        $templates = Nocspl::where('is_template',1)->get() ;
        return Response()->json(compact('templates'));
    }

}
