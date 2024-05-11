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

    public function get_screens_from_spls(Request $request )
    {
        $location = $request->location ;
        $screens = array() ;
        foreach($request->array_spls as $spl)
        {
            $spls = Spl::where('uuid',$spl)->where('location_id',$location)->orderBy('screen_id', 'ASC')->get() ;
            foreach( $spls as $spl)
            {
                $screen = $spl->screen ;
                if ( ! in_array($screen->id,  array_column($screens, 'id')))
                {
                    array_push($screens,  array("id" => $screen->id ,"screen_number" => $screen->screen_number , "name" => $screen->screen_name));
                }
            }
        }
        $screens_id = array_column($screens, 'id');
        array_multisort($screens_id, SORT_ASC, $screens);
        return Response()->json(compact('screens'));

    }

    public function delete_spls(Request $request )
    {
        $location = Location::findOrFail($request->location) ;
        $response = $this->delete_splRequest($location->connection_ip, $request->lms, $request->array_spls, $request->array_screens, $location->email , $location->password);

        $response['result'] = 1 ;
        if($response['result'] === 1 )
        {
            foreach($request->array_spls as $spl_uuid)
            {
                if($request->lms)
                {
                    $spl = Lmsspl::where('uuid',$spl_uuid)->where('location_id',$location->id)->delete();
                //    dd($cpl,$cpl_uuid) ;
                }
                $spl = Spl::where('uuid',$spl_uuid)->whereIn('screen_id',$request->array_screens)->where('location_id',$location->id)->delete() ;
                //dd($cpl,$cpl_uuid) ;
            }
                echo "Success" ;
        }
        else
        {
            echo "Failed" ;
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

}
