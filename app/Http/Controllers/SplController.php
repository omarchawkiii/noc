<?php

namespace App\Http\Controllers;

use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;
use Response ;
use SoulDoit\DataTable\SSP;

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
                            'screen_id' => $screen->id
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
        $cpls = $spl->cpls ;
      //  $schedules =  $spl->schedules ;
        $schedules =Schedule::with('screen')->where('spl_id',$spl->id)->get();
        return Response()->json(compact('spl','cpls','schedules'));
    }


    public function spl_by_screen(Screen $screen)
    {
        $screens = $screen->location->screens ;
        $locations = Location::all() ;
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
            $spls =Lmsspl::all();
        }
        else
        {
            $spls =Spl::all();
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
            $locations = Location::all() ;

            return view('spls.index', compact('screen','screens','locations'));
        }

        if(isset($screen) && $screen != 'null' )
        {
            $spls =$spls->where('screen_id',$screen);
        }
        return Response()->json(compact('spls','screens'));
    }




}
