<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Lmscpl;
use App\Models\Location;
use App\Models\Macro;
use App\Models\Playback;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use App\Models\splcomponents;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                            'editRate_numerator' => $cpl['editRate_numerator'] ,
                            'editRate_denominator' => $cpl['editRate_denominator'] ,
                            'cinema_DCP' => $cpl['Cinema_DCP'] ,
                            'aspect_Ratio' => $cpl['Aspect_Ratio'],


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
        //return Redirect::back()->with('message' ,' The cpls  has been updated');
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
        $screen = $request->screen_id;

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
               // dd($cpls->get()) ;
            }
            if($multiplex =='unlinked')
            {
                $cpls =$cpls->where('cpl_is_linked',0);
               // dd($cpls->get()) ;
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


        $cpls = $cpls->orderBy('contentTitleText', 'ASC')->get() ;
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

        $cpls = DB::table('cpls')->whereIn('location_id',$locations)->groupBy('uuid')
        ->orderBy('contentKind', 'ASC')->orderBy('contentTitleText', 'ASC')->distinct()->get();
        $lmscpls = DB::table('lmscpls')->whereIn('location_id',$locations)->groupBy('uuid')
        ->orderBy('contentKind', 'ASC')->orderBy('contentTitleText', 'ASC')->distinct()->get();


        $all_cpls = $cpls->merge($lmscpls)->unique('uuid');

        $macros = Macro::whereIn('location_id',$locations)->groupBy('idmacro_config')->orderBy('section_title', 'ASC')->get() ;
        return Response()->json(compact('cpls','screens','macros'));

    }
    public function get_cpl_infos($location , $cpl )
    {

        $cpl = Cpl::where('id',$cpl)->where('location_id',$location)->first() ;

        $spls = DB::table('splcomponents')
            ->where('splcomponents.location_id',$cpl->location_id)
            ->where('splcomponents.CompositionPlaylistId',$cpl->uuid)
            ->leftJoin('spls', 'splcomponents.uuid_spl', '=', 'spls.uuid')
            ->leftJoin('lmsspls', 'splcomponents.uuid_spl', '=', 'lmsspls.uuid')
            ->select('splcomponents.uuid_spl as uuid_spl','spls.name as name','lmsspls.name as lms_name','spls.duration as duration')
            ->groupBy('splcomponents.uuid_spl')
            ->get();



        $kdms =Kdm::with('screen')->where('cpl_uuid',$cpl->uuid)->where('location_id',$location)->get();
      //  $schedules =  $spl->schedules ;
        //$schedules =Schedule::with('screen')->where('spl_id',$cpl->id)->get();
       // $schedules = null ;

        return Response()->json(compact('cpl','spls','kdms'));
    }

    public function get_screens_from_cpls(Request $request )
    {
        $location = $request->location ;
        $screens = array() ;
        foreach($request->array_cpls as $cpl)
        {
            $cpls = Cpl::where('uuid',$cpl)->where('location_id',$location)->orderBy('screen_id', 'ASC')->get() ;
            foreach( $cpls as $cpl)
            {
                $screen = $cpl->screen ;
                //$screen = Screen::with('playback')->where('id',$cpl->screen_id)->first();

                if ( ! in_array($screen->id,  array_column($screens, 'id')))
                {
                    $playable = Playback::where('screen_id',$screen->id)->where('location_id',$location)->first() ;
                    array_push($screens,  array("id" => $screen->id ,"screen_number" => $screen->id_server , "name" => $screen->screen_name, "playback_status" => $playable->playback_status));
                }
            }
        }
        $screens_id = array_column($screens, 'id');
        array_multisort($screens_id, SORT_ASC, $screens);
        return Response()->json(compact('screens'));


    }

    public function delete_cpl(Request $request )
    {
        $location = Location::findOrFail($request->location) ;

        //$response = $this->delete_cplRequest($request->connection_ip, $request->lms, $request->array_cpls, $request->array_screens, $location->email , $location->password);
        $response = $this->delete_cplRequest($location->connection_ip,$request->array_cpls, $request->array_screens, $request->lms,$location->email, $location->password);
        //$response['result'] = 1 ;

        if(count($response['errors']) === 0)
        {
            foreach($request->array_cpls as $cpl_uuid)
            {
                if($request->lms)
                {
                    $cpl = Lmscpl::where('uuid',$cpl_uuid)->where('location_id',$location->id)->delete();
                }
                $screens= Screen::whereIn('id_server',$request->array_screens)->where('location_id',$location->id)->get()->toArray();
                $screens_id = array_column($screens, 'id');
                $cpl = Cpl::with('screen')->where('uuid',$cpl_uuid)->whereIn('screen_id',$screens_id)->where('location_id',$location->id)->delete() ;
            }
            $deleted_cpls = $response['deleted_cpls'] ;
            $errors = $response['errors'] ;
            $status = 1 ;
            return Response()->json(compact('status','deleted_cpls','errors'));

        }
        else
        {
            $deleted_cpls =null ;
            $errors =null ;
            $status = 0 ;
            return Response()->json(compact('status','deleted_cpls','errors'));
        }
    }


    public function delete_cplRequest($apiUrl,$list_cpls, $list_screens, $lms,$username, $password)
    {

        // Prepare the request data
        $requestData = [
            'action' => 'deleteCplByUuidScreenNumbers',
            'username' => $username,
            'password' => $password,
            'list_cpls' => $list_cpls,
            'list_screens' => $list_screens,
            'lms' => $lms,
        ];

        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Curl error: ' . curl_error($ch)];

        }

        // Close cURL session
        curl_close($ch);

        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            return json_decode($response, true);

        }
    }


    public function clean_cpls(Request $request)
    {

        $lms = $request->lms;
        $screen= $request->screen;
        $location = Location::find($request->location) ;

        if($lms)
        {
            $url = $location->connection_ip."?request=get_lms_content_to_clean";
        }
        else
        {
            $url = $location->connection_ip."?request=get_screen_content_to_clean&id_screen=".$screen;
        }

        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents['content_to_clean'])
        {
            $content_to_clean = $contents["content_to_clean"];
            return Response()->json(compact('content_to_clean'));

        }
        $content_to_clean = [];
        return Response()->json(compact('content_to_clean'));

    }

    public function confirm_clean_cpls(Request $request)
    {
        $location = Location::findOrFail($request->location) ;
        $lms = $request->lms;
        $screen= $request->screen;
        if($lms)
        {
           $action = 'clean_lms_content' ;
        }
        else
        {
            $action = 'clean_screen_content' ;
        }

        $response = $this->clean_cplRequest($location->connection_ip,$action, $screen , $location->email, $location->password);
        return Response()->json(compact('status','count_cpls'));

    }


    function clean_cplRequest($apiUrl,$action, $id_screen, $username,$password) {
        // Prepare the request data
        $requestData = [
            'action' => $action,
            'username' => $username,
            'password' => $password,
            'id_screen' =>$id_screen,
        ];
        // Initialize cURL session
        $ch = curl_init($apiUrl);
        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
       // print_r($response);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Curl error: ' . curl_error($ch)];
        }

        // Close cURL session
        curl_close($ch);

        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            return json_decode($response, true);
        }
    }

}
