<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Screen;
use App\Models\Spl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CplController extends Controller
{
    public function getcpls(Location $location,  $screen )
    {

        $screen = Screen::find($screen);


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


}
