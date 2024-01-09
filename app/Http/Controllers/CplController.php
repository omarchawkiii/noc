<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Lmscpl;
use App\Models\Location;
use App\Models\Macro;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CplController extends Controller
{
    public function getcpls($location,  $screen )
    {
        $screen = Screen::find($screen);
        $location = Location::find($location) ;

        $url = $location->connection_ip."?request=getCplListByScreenNumber&screen_number=".$screen->screen_number;

        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $cpl)
                    {


                        Cpl::updateOrCreate([
                            'id' => $cpl["uuid"],
                            'location_id' => $location->id
                        ],[
                            'id' => $cpl["uuid"],
                            'id_dcp' => $cpl["id_dcp"],
                            'contentTitleText' => $cpl["contentTitleText"],
                            'contentKind' => $cpl["contentKind"],
                            'EditRate' => $cpl["EditRate"],
                            'is_3D' => $cpl["is_3D"],
                            'totalSize' => $cpl["totalSize"],
                            'soundChannelCount' => $cpl["soundChannelCount"],
                            'durationEdits' => $cpl["durationEdits"],
                            'ScreenAspectRatio' => $cpl["ScreenAspectRatio"],
                            'available_on' => $cpl["available_on"],
                            'serverName' => $cpl["serverName"],
                            'cpl_is_linked' => $cpl["cpl_is_linked"],
                            'screen_id'     =>$screen->id,
                            'location_id'     =>$location->id,
                        ]);
                    }

                    /*if(count($content) != $screen->cpls->count() )
                    {
                        $uuid_cpls = array_column($content, 'uuid');
                            foreach($screen->cpls as $cpl)
                            {
                                if (! in_array( $cpl->uuid , $uuid_cpls))
                                {
                                    $cpl->delete() ;
                                }
                            }

                        //dd('we should delete screens ') ;
                    }*/
                }
            }
        }
        return Redirect::back()->with('message' ,' The cpls  has been updated');
    }

    public function cpl_by_screen(Screen $screen)
    {
        $screens = $screen->location->screens ;
        $locations = Location::all() ;
        return view('cpls.index', compact('screen','screens','locations'));
    }

    public function get_cpl_with_filter(Request $request )
    {

        $location = $request->location;
        $country = $request->country;
        $screen = $request->screen;
        $lms= $request->lms ;
        $playlist_builder= $request->playlist_builder ;
        $macros = null ;

        if( $lms == 'true')
        {
            $cpls =Lmscpl::with('location');
        }
        else
        {
            $cpls =Cpl::with('location');
        }


        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $cpls =$cpls->where('location_id',$location->id);
        }
        else
        {
            $screens =null;
            $screen=null ;
            $locations = Location::all() ;
            return view('cpls.index', compact('screen','screens','locations'));
        }
       // dd($cpls->get()) ;

        if(isset($screen) && $screen != 'null' )
        {
            $cpls =$cpls->where('screen_id',$screen);
        }

        if(isset($playlist_builder) && $screen != 'null')
        {
            $cpls = $cpls->orderBy('contentKind', 'ASC')->orderBy('contentTitleText', 'ASC') ;
            $macros = Macro::where('location_id',$location->id)->get() ;

        }
        $cpls = $cpls->get() ;
        return Response()->json(compact('cpls','screens','macros'));

    }

    public function get_cpl_infos($location , $cpl )
    {
        $cpl = Cpl::where('id',$cpl)->where('location_id',$location)->first() ;

        $spls = $cpl->spls ;
        $kdms = $cpl->kdms ;

        $kdms =Kdm::with('screen')->where('cpl_id',$cpl->id)->get();
      //  $schedules =  $spl->schedules ;
        //$schedules =Schedule::with('screen')->where('spl_id',$cpl->id)->get();
        $schedules = null ;
        return Response()->json(compact('cpl','spls','kdms'));
    }

}
