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
use App\Models\splcomponents;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
                        $id = $cpl["uuid"] ."-".$location->id.'-'.$screen->id ;
                        if(isset($cpl["playable"]))
                        {
                            if($cpl["playable"] == 1 )
                            {
                                $playable  = 1 ;
                            }
                            else
                            {
                                $playable  =0;
                            }
                        }
                        else
                        {
                            $playable  =0;
                        }

                        Cpl::updateOrCreate([
                            'id' => $id ,
                            'location_id' => $location->id
                        ],[
                            'id' => $id,
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
                            'playable' => $playable ,
                            'pictureEncodingAlgorithm' => $cpl['pictureEncodingAlgorithm'] ,
                            'pictureEncryptionAlgorithm' => $cpl['pictureEncryptionAlgorithm'] ,
                            'soundQuantizationBits' => $cpl['soundQuantizationBits'] ,
                            'soundEncodingAlgorithm' => $cpl['soundEncodingAlgorithm'] ,
                            'soundEncryptionAlgorithm' => $cpl['soundEncryptionAlgorithm'] ,
                            'markersCount' => $cpl['markersCount'] ,
                            'pictureWidth' => $cpl['pictureWidth'],
                            'pictureHeight' => $cpl['pictureHeight'] ,
                            'type' => $cpl['type'] ,
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
                    }
                }
            }
        }
        return Redirect::back()->with('message' ,' The cpls  has been updated');
    }

    public function cpl_by_screen(Screen $screen)
    {
        $screens = $screen->location->screens ;
        if( Auth::user()->role != 1)
            {
                $locations = Auth::user()->locations ;
            }
            else
            {
                $locations = Location::all() ;
            }
        return view('cpls.index', compact('screen','screens','locations'));
    }

    public function get_cpl_with_filter(Request $request )
    {

        $location = $request->location;
        $country = $request->country;
        $screen = $request->screen;
        $lms= $request->lms ;
        $multiplex=$request->multiplex ;
        $playlist_builder= $request->playlist_builder ;
        $macros = null ;

        if( $lms == 'true' )
        {
            $cpls =Lmscpl::with('location');
        }
        else
        {
            $cpls =Cpl::with('location');
        }


        if(isset($location) &&  $location != 'null' )
        {
            if($location != 'all')
            {
                $location = Location::find($location) ;
                $screens =$location->screens ;
                $cpls =$cpls->where('location_id',$location->id)->groupBy('uuid');
            }

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
            return view('cpls.index', compact('screen','screens','locations'));
        }
       // dd($cpls->get()) ;

        if(isset($screen) && $screen != 'null' )
        {
            $cpls =$cpls->where('screen_id',$screen);
        }

        if(isset($playlist_builder) && $playlist_builder != 'null')
        {

            if($location == 'all')
            {
                $location = null ;
                $screens =null ;
                $cpls =Lmscpl::with('location')->groupBy('uuid');
               // dd($cpls->get()) ;
               $macros = Macro::get() ;
            }
            else
            {
                $macros = Macro::where('location_id',$location->id)->get() ;
            }


            $cpls = $cpls->orderBy('contentKind', 'ASC')->orderBy('contentTitleText', 'ASC') ;


        }

        if(isset($multiplex) && $multiplex != 'null' )
        {
            if($multiplex =='linked')
            {
                $cpls =$cpls->where('cpl_is_linked',1);
            }
            if($multiplex =='unlinked')
            {
                $cpls =$cpls->where('cpl_is_linked',0);
            }
            if($multiplex =='Encryped')
            {
                $cpls =$cpls->where('pictureEncryptionAlgorithm','!=','None')->where('pictureEncryptionAlgorithm','!=','0')->where('pictureEncryptionAlgorithm','!=',null);

            }
            if($multiplex =='NoEncryped')
            {
                $cpls =$cpls->where('pictureEncryptionAlgorithm','None')->orWhere('pictureEncryptionAlgorithm','0')->orWhere('pictureEncryptionAlgorithm',null);
            }

            if($multiplex =='Flat')
            {
                $cpls =$cpls->where('type','Flat');
            }

            if($multiplex =='Scope')
            {
                $cpls =$cpls->where('type','Scope');
            }


        }


        $cpls = $cpls->get() ;
        return Response()->json(compact('cpls','screens','macros'));

    }

    public function get_cpl_with_filter_for_noc(Request $request )
    {
        $location = $request->location;
        $country = $request->country;
        $screen = $request->screen;
        $lms= $request->lms ;
        $playlist_builder= $request->playlist_builder ;
        $macros = null ;
        $locations= explode(',', $location);

        $screens=null ;
        $cpls =Lmscpl::with('location')->whereIn('location_id',$locations)->groupBy('uuid');

        $cpls = $cpls->orderBy('contentKind', 'ASC')->orderBy('contentTitleText', 'ASC') ;
        $cpls = $cpls->get() ;
        $macros = Macro::whereIn('location_id',$locations)->groupBy('idmacro_config')->orderBy('section_title', 'ASC')->get() ;
        return Response()->json(compact('cpls','screens','macros'));

    }
    public function get_cpl_infos($location , $cpl )
    {
        $cpl = Cpl::where('id',$cpl)->where('location_id',$location)->first() ;

        //$spls = $cpl->spls ;
        //dd($cpl->uuid) ;
        $spls = splcomponents::with('spl')->where('CompositionPlaylistId',$cpl->uuid)->get() ;

        //dd($cpl);
        $kdms = $cpl->kdms ;

        $kdms =Kdm::with('screen')->where('cpl_id',$cpl->id)->get();
      //  $schedules =  $spl->schedules ;
        //$schedules =Schedule::with('screen')->where('spl_id',$cpl->id)->get();
        $schedules = null ;
        return Response()->json(compact('cpl','spls','kdms'));
    }

    public function get_screens_from_cpls(Request $request )
    {
        $location = $request->location ;
        $screens = array() ;
        foreach($request->array_cpls as $cpl)
        {
            $cpl = Cpl::find($cpl) ;
            $screen = $cpl->screen ;
            if ( ! in_array($screen->id,  array_column($screens, 'id')))
            {
                array_push($screens,  array("id" => $screen->id , "name" => $screen->screen_name));
            }




        }
        return Response()->json(compact('screens'));


    }


}
