<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Location;
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
                            'uuid' => $cpl["uuid"],
                            'screen_id' => $screen->id
                        ],[
                            'uuid' => $cpl["uuid"],
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

                    if(count($content) != $screen->cpls->count() )
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
                    }
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
        if($lms== true)
        {
            $location = Location::find($location) ;
            if($location)
            {
                $screens =$location->screens ;
                $cpls =$location->lmscpls ;
            }
            else
            {
                $screens =null;
                $cpls=null;
            }


            return Response()->json(compact('cpls','screens'));
        }

        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $cpls =$location->cpls ;
            return Response()->json(compact('cpls','screens'));
        }
        else
        {
            if(isset($screen) && $screen != 'null' )
            {
                $cpls = Screen::find($screen)->cpls;
                return Response()->json(compact('cpls'));
            }
            else
            {
                $locations = Location::all() ;
                $cpls =null ;
                $screens = null ;
                return view('cpls.index', compact('screen','screens','locations'));

            }

        }




    }

    public function get_cpl_infos($cpl )
    {
        $cpl = Cpl::find($cpl) ;
        $spls = $cpl->spls ;
        $kdms = $cpl->kdms ;
        $kdms =Kdm::with('screen')->where('cpl_id',$cpl->id)->get();
      //  $schedules =  $spl->schedules ;
        //$schedules =Schedule::with('screen')->where('spl_id',$cpl->id)->get();
        $schedules = null ;
        return Response()->json(compact('cpl','spls','kdms'));
    }



}