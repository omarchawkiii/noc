<?php

namespace App\Http\Controllers;

use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Nocspl;
use App\Models\Playback;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use App\Models\splcomponents;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
        try{
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
                        }
                    }
                }
            }
            return Redirect::back()->with('message' ,' The Screens  has been updated');
        }
        catch (RequestException $e) {
            // Log de l'erreur ou traitement spécifique
            echo " message: " . $e->getMessage();
        }
        catch (\Exception $e) {
            // Capture d'autres exceptions générales
            echo " message: " . $e->getMessage();
        //     return Redirect::back()->with('error', 'Unexpected error for location: ' . $location->id);
        }
    }

    public function get_spl_infos($spl)
    {
        $spl = Spl::find($spl) ;
       // $cpls = $spl->cpls ;
        //$cpls = $spl->splcomponents ;
        $cpls = splcomponents::where('uuid_spl',$spl->uuid)->where('location_id',$spl->location_id)->get() ;
      //  $schedules =  $spl->schedules ;
        $schedules =Schedule::with('screen')->where('uuid_spl',$spl->uuid)->where('date_start' , '>' , Carbon::today() )->where('location_id',$spl->location_id)->get();
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
        $noc_local_storage= $request->noc_local_storage ;
        if($noc_local_storage == 'true')
        {
            $spls = Nocspl::with('location')->get() ;
            $screens =null ;
            return Response()->json(compact('spls','screens'));
        }
        else
        {
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

    public function get_screens_from_spls(Request $request )
    {
        $location = $request->location ;
        $screens = array() ;

        foreach($request->array_spls as $spl)
        {

            if($request->lms)
            {
                //$spls = Lmsspl::where('uuid',$spl)->where('location_id',$location)->get() ;
                $spls = Spl::where('uuid',$spl)->where('location_id',$location)->orderBy('screen_id', 'ASC')->get() ;
            }
            else
            {
                $spls = Spl::where('uuid',$spl)->where('location_id',$location)->orderBy('screen_id', 'ASC')->get() ;
            }


            foreach( $spls as $spl)
            {

                $screen = $spl->screen ;
                $screen = Screen::where('id',$spl->screen_id)->where('location_id',$location)->first() ;

                if ( ! in_array($screen->id,  array_column($screens, 'id')))
                {
                    $playable = Playback::where('screen_id',$screen->id)->where('location_id',$location)->first() ;
                    array_push($screens,  array("id" => $screen->id ,"screen_number" => $screen->screen_number , "name" => $screen->screen_name, "id_server" => $screen->id_server, "playback_status" => $playable->playback_status));
                }
            }
        }
        $screens_id = array_column($screens, 'id');
        array_multisort($screens_id, SORT_ASC, $screens);
        return Response()->json(compact('screens'));

    }

    public function delete_spls(Request $request )
    {

        if($request->noc_local_storage == 'true')
        {
            foreach($request->array_spls as $spl_uuid)
            {
                $nocspl = Nocspl::where('uuid',$spl_uuid)->first() ;
                $path = storage_path(). '/app/xml_file/'.$nocspl->xmlpath ;
                if($nocspl->delete())
                {
                    $res =unlink($path);
                    if($res)
                    {
                        //echo 'Success' ;
                    }
                    else
                    {
                        //echo 'Failed' ;
                    }
                }
                else
                {
                    //echo 'Failed' ;
                }

            }
            $deleted_cpls = null ;
            $errors = null ;
            $status = 1 ;
            return Response()->json(compact('status','deleted_cpls','errors'));
        }
        else
        {

            $location = Location::findOrFail($request->location) ;
            $response = $this->delete_splRequest($location->connection_ip, $request->lms, $request->array_spls, $request->array_screens, $location->email , $location->password);
            //dd($response);
            //$response['result'] = 1 ;

            if(count($response['errors']) === 0)
            {
                foreach($request->array_spls as $spl_uuid)
                {
                    if($request->lms)
                    {
                        $spl = Lmsspl::where('uuid',$spl_uuid)->where('location_id',$location->id)->delete();
                    }
                    if($request->array_screens)
                    {
                        $screens= Screen::whereIn('id_server',$request->array_screens)->where('location_id',$location->id)->get()->toArray();
                        $screens_id = array_column($screens, 'id');
                        $spl = Spl::with('screen')->where('uuid',$spl_uuid)->whereIn('screen_id',$screens_id)->where('location_id',$location->id)->delete() ;
                    }


                }
                $deleted_spls = $response['deleted_spls'] ;
                $errors = $response['errors'] ;
                $status = 1 ;
                return Response()->json(compact('status','deleted_spls','errors'));
            }
            else
            {
                $deleted_spls =null ;
                $errors =null ;
                $status = 0 ;
                return Response()->json(compact('status','deleted_spls','errors'));
            }
        }
    }


    function delete_splRequest($apiUrl,$lms, $array_spls, $array_screens,$username,$password) {

        // Prepare the request data
        $requestData = [
            'action' => 'deleteSplByUuidScreenNumbers',
            'lms' => $lms,
            'list_spls' => $array_spls,
            'list_screens' => $array_screens,
            'username' =>$username,
            'password' =>$password
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


    public function download_spl(Request $request)
    {

        $location = Location::findOrFail($request->location) ;

        //$spl = Spl::where('uuid',$request->spl_id)->first() ;
        $response = $this->get_spl_from_API_for_download($location->connection_ip,$request->spl_id,$location->email , $location->password) ;

    }

    public function get_spl_from_API($apiUrl,$uuid,$username,$password)
    {
        // Prepare the request data
        $requestData = [
            'action' => 'get_spl',
            'uuid' => $uuid,
            'username' => $username,
            'password' => $password
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

           return  $response;
        print_r($response);
        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            return json_decode($response, true);
        }
    }
      public function get_spl_from_API_for_download($apiUrl,$uuid,$username,$password)
    {
        // Prepare the request data
        $requestData = [
            'action' => 'get_spl',
            'uuid' => $uuid,
            'username' => $username,
            'password' => $password
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


        print_r($response);
        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            return json_decode($response, true);
        }
    }


    public function clean_spls(Request $request)
    {

        $lms = $request->lms;
        $location = Location::find($request->location) ;

        if($lms == "true")
        {
            $apiUrl = $location->connection_ip;
            $requestData = [
                'action' => 'clean_lms_spls',
                'username' =>$location->email,
                'password' =>$location->password
            ];

        }
        else
        {
            $screen = Screen::find($request->screen) ;
            $apiUrl = $location->connection_ip;
            $requestData = [
                'action' => 'clean_screen_spls',
                'screen_number' => $screen->screen_number,
                'username' =>$location->email,
                'password' =>$location->password
            ];

        }


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
