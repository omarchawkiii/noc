<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Location;
use App\Models\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KdmController extends Controller
{
    public function getkdms($location,$screen )
    {

        $screen = Screen::find($screen);
        $location = Location::find($location) ;
        $url = $location->connection_ip . "?request=getKdmListByScreenNumber&screen_number=".$screen->screen_number;
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $kdm)
                    {

                        $cpl = Cpl::where('uuid','=',$kdm['cplId'])->where('location_id','=',$location->id)->first() ;


                        if($cpl)
                        {
                            Kdm::updateOrCreate([
                                'uuid' => $kdm["uuid"],
                                'location_id' => $location->id
                            ],[
                                'uuid' => $kdm['uuid'],
                                'name' => $kdm['ContentTitleText'],
                                'ContentKeysNotValidBefore' => $kdm['ContentKeysNotValidBefore'],
                                'ContentKeysNotValidAfter' => $kdm['ContentKeysNotValidAfter'],
                                'kdm_installed' => $kdm['kdm_installed'],
                                'content_present' => $kdm['content_present'],
                                'serverName_by_serial' => $kdm['serverName_by_serial'],
                                'cpl_id' => $cpl->id,

                                'screen_id' => $screen->id,
                                'location_id' => $location->id,

                            ]);
                        }
                        else
                        {
                            //dd('no Cpl with this UUID ' , $cpl) ;
                        }
                    }

                    if(count($content) != $screen->kdms->count() )
                    {

                        $uuid_kdms = array_column($content, 'uuid');

                            foreach($screen->kdms as $kdm)
                            {
                                if (! in_array( $kdm->uuid , $uuid_kdms))
                                {
                                    // delete deleted screen
                                    $kdm->delete() ;
                                }
                            }

                        //dd('we should delete screens ') ;
                    }

                }
            }
        }
        return Redirect::back()->with('message' ,' The Screens  has been updated');
    }

    public function get_Kdm_with_filter (Request $request )
    {


        $location = $request->location;
        $country = $request->country;
        $screen = $request->screen;

        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $kdms =$location->kdms ;
            return Response()->json(compact('kdms','screens'));
        }
        else
        {
            if(isset($screen) && $screen != 'null' )
            {
                $kdms = Screen::find($screen)->kdms ;
                return Response()->json(compact('kdms'));
            }
            else
            {
                $locations = Location::all() ;
                $cpls =null ;
                $screens = null ;
                return view('kdms.index', compact('screen','screens','locations'));

            }

        }




    }

}
