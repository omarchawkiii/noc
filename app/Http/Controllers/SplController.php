<?php

namespace App\Http\Controllers;

use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Nocspl;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use App\Models\splcomponents;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;
use Response ;

class SplController extends Controller
{


    public function getspls( $location,  $screen )
    {
        $screen = Screen::find($screen);
        $location = Location::find($location) ;

        $url = $location->connection_ip . "?request=getSplListInfoByScreenNumber&screen_number=".$screen->screen_number;
        echo "URL : " . $url . " <br />" ;
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);
        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $spl)
                    {
                        Spl::updateOrCreate([
                            'uuid' => $spl["uuid"],
                            'screen_id' => $screen->id,

                        ],[
                            'uuid'     => $spl["uuid"],
                            'name'     => $spl["title"],
                            'duration'     => gmdate("H:i:s", $spl["duration"]) ,
                            'available_on'     => $spl["available_on"],
                            'screen_id'     =>$screen->id,
                            'location_id'     =>$location->id,
                        ]);
                    }

                    // check if SPLs deleted
                    if(count($content) != $screen->spls->count() )
                    {
                        $uuid_spls = array_column($content, 'uuid');
                            foreach($screen->spls as $spl)
                            {
                                if (! in_array( $spl->uuid , $uuid_spls))
                                {
                                    // delete deleted screen
                                    $spl->delete() ;
                                }
                            }

                        //dd('we should delete screens ') ;
                    }


                }
            }
        }
        return Redirect::back()->with('message' ,' The Screens  has been updated');
    }

    public function get_spl_infos($spl )
    {
        $spl = Spl::find($spl) ;
       // $cpls = $spl->cpls ;
        //$cpls = $spl->splcomponents ;
        $cpls = splcomponents::where('uuid_spl',$spl->uuid)->get() ;
      //  $schedules =  $spl->schedules ;
        $schedules =Schedule::with('screen')->where('spl_id',$spl->id)->get();
        return Response()->json(compact('spl','cpls','schedules'));
    }


    public function spl_by_screen(Screen $screen)
    {
        $screens = $screen->location->screens ;

        $locations = Location::whereHas('locations', function($q) {
            $q->whereIn('user_id', Auth::user()->id);
        })->get();

        //$locations = Location::all() ;
        return view('spls.index', compact('screen','screens','locations'));
    }

    public function get_spl_with_filter(Request $request )
    {

        $location = $request->location;
        $country = $request->country;
        $screen = $request->screen;

        $lms= $request->lms ;

        if( $lms == 'true')
        {
            $spls =Lmsspl::groupBy('uuid');
        }
        else
        {
            $spls =Spl::groupBy('uuid');
        }
        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $spls =$spls->where('location_id',$location->id);
        }
        else
        {
            $screens =null;
            $screen=null ;

            if( Auth::user()->role != 1)
            {
                $locations = Auth::user()->locations ;
            }
            else
            {
                $locations = Location::all() ;
            }

            return view('spls.index', compact('screen','screens','locations'));
        }

        if(isset($screen) && $screen != 'null' )
        {
            $spls =$spls->where('screen_id',$screen);

        }
       // $spls =$spls->groupBy('uuid') ;

        $spls = $spls->get() ;
        return Response()->json(compact('spls','screens'));
    }


    public function spl_builder()
    {
        $locations = Location::all() ;
        return view('spls.splbuilder', compact('locations'));
    }

    public function upload_spl()
    {
        $locations = Location::all() ;
        return view('spls.uploadspl', compact('locations'));
    }
}
