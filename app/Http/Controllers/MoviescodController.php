<?php

namespace App\Http\Controllers;

use App\Models\Lmscpl;
use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Moviescod;
use App\Models\Nocspl;
use App\Models\Spl;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviescodController extends Controller
{
    public function getMoviesCods($location)
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=getMoviesCods";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);
        //dd($contents);
        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $moviescod)
                    {
                        if($moviescod['exist_inPos'] == 1 )
                        {
                            $exist_inPos = 1 ;
                        }
                        else
                        {
                            $exist_inPos = 0 ;
                        }

                        Moviescod::updateOrCreate([
                            'moviescods_id' => $moviescod['id'],
                            'location_id' => $location->id,
                        ],[

                            'moviescods_id' => $moviescod['id'],
                            'code' => $moviescod['code'],
                            'title' => $moviescod['title'],
                            'titleShort' => $moviescod['titleShort'],
                            'last_update' => $moviescod['last_update'],
                            'status' => $moviescod['status'],
                            'exist_inPos' =>$exist_inPos,
                            'location_id'     =>$location->id,
                            'spl_uuid'     =>$moviescod['id_spl'],
                        ]);
                    }

                    if(count($content) != $location->moviescod->count() )
                    {
                        $uuid_moviescod = array_column($content, 'id');
                            foreach($location->moviescod as $moviecod)
                            {
                                if (! in_array( $moviecod->moviescods_id , $uuid_moviescod))
                                {
                                    $moviecod->delete() ;
                                }
                            }
                    }

                }
            }


        }
     //   return Redirect::back()->with('message' ,' The cpls  has been updated');
    }

    public function get_spl_and_movies(Request $request)
    {
        $location = $request->location;
        //$location = Location::find($location) ;
        $movies = Moviescod::where('location_id',$request->location)->where('status','unlinked')->where('exist_inPos',1)->orderBy('title', 'ASC')->get() ;


        $lms_spl = Lmsspl::where('location_id' ,$location )->select('lmsspls.*','lmsspls.name as spl_title')->groupBy('uuid')->orderBy('spl_title', 'ASC')->get() ;
        $lms_spl_uuid = array_column($lms_spl->toArray(), 'uuid');
        $nos_spls = Nocspl::whereNotIn('uuid', $lms_spl_uuid)->get() ;

       /* $noc_and_location_spls = $nosspls->merge($spl_location);
        $nos_spls =  $noc_and_location_spls ;*/

        return Response()->json(compact('nos_spls','lms_spl','movies'));

    }

    public function add_movies_to_spls(Request $request)
    {
        //$apiUrl = 'http://localhost/tms/system/api2.php';
        $moviescod = Moviescod::findOrFail($request->movie_id) ;
        $splnoc= Nocspl::where('uuid',$request->spl_id)->where('location_id',$moviescod->location_id)->first();
        $spllms= Lmsspl::where('uuid',$request->spl_id)->where('location_id',$moviescod->location_id)->first();

       // dd($splnoc);
        $location = $moviescod->location ;
        $apiUrl = $location->connection_ip;

        if($request->time_schedule)
        {
            $date_schedule =$request->date_schedule ;
            $time_schedule = $request->time_schedule ;
            $date_time = $date_schedule ." ". $time_schedule .":00";

            $moviescod = Moviescod::findOrFail($request->movie_id)->update([
                'spl_uuid' => $request->spl_id,
                'date_linking'=> $date_time ,
                'status' => "pending"
            ]);
            if($moviescod)
            {
                echo "Success" ;
            }
            else
            {
                echo "Failed" ;
            }
        }
        else
        {
            if($spllms != null)
            {
                $check_lms_spl  = true ;
            }
            else
            {
                $check_lms_spl = Lmsspl::where('uuid' , $request->spl_id)->where('location_id',$moviescod->location_id)->first() ;
            }

            if($check_lms_spl)
            {
                //$location = Location::findOrFail($check_lms_spl->location_id) ;
                //$this->sendUpdateLinksRequest($location->connection_ip, $moviescod->moviescods_id, $splnoc->uuid);
                $response = $this->sendUpdateLinksRequest($apiUrl, $moviescod->code, $request->spl_id, $location->email , $location->password);
                //$response['result'] = 1 ;
                //dd($response);
                if($response['result'] === 1 )
                {
                    $moviescod = Moviescod::findOrFail($request->movie_id)->update([
                    'spl_uuid' => $request->spl_id,
                    'status' => "linked"
                    ]);

                    if($moviescod)
                    {
                        echo "Success" ;
                    }
                    else
                    {
                        echo "Failed" ;
                    }
                }
                else
                {
                    echo "Failed" ;
                }
            }
            else
            {
                echo "missing" ;
            }
        }

    }

    public function link_pending_spl_movies()
    {
        $moviescods = Moviescod::where('status','pending')->where('date_linking','<=',Carbon::now())->get() ;
        dd($moviescods) ;
        foreach($moviescods  as $moviescod)
        {
            $location = $moviescod->location ;
            $apiUrl = $location->connection_ip;
            $response = $this->sendUpdateLinksRequest($apiUrl, $moviescod->code, $moviescod->spl_uuid, $location->email , $location->password);
            if($response['result'] === 1 )
            {
                $moviescod = $moviescod->update([
                    'status' => "linked"
                ]);
            }
        }
    }

    public function get_spl_and_movies_linked(Request $request)
    {
        $location = $request->location;
        //$location = Location::find($location) ;
       // $movies = Moviescod::where('status','linked')->with('nocspl')->where('location_id',$request->location)->get() ;
        $movies = DB::table('moviescods')
            //->leftJoin('nocspls', 'moviescods.spl_uuid', '=', 'nocspls.uuid')
            ->leftJoin('lmsspls', 'moviescods.spl_uuid', '=', 'lmsspls.uuid')
            ->where('moviescods.location_id',$request->location)
            ->where('status','!=','unlinked7')
            ->select('lmsspls.id as id_spl' ,'lmsspls.name as title_spl', 'moviescods.*')
            ->groupBy('uuid')
            ->get();
        return Response()->json(compact('movies'));
    }

    public function unlink_spl_movie(Request $request)
    {

        //$apiUrl = 'http://localhost/tms/system/api2.php';

        $moviescod = Moviescod::findOrFail($request->movie_id) ;

        $location = Location::findOrFail($request->location) ;
        $apiUrl = $location->connection_ip ;
        $response = $this->sendUnlinkSplRequest($apiUrl, $moviescod->code, $location->email , $location->password);
        $response['result'] = 1 ;

        if($response['result'] === 1 )
        {
            $moviescod = $moviescod->update([
                'spl_uuid' => null,
                'status' => "unlinked"
            ]);

            if($moviescod)
            {
                echo "Success" ;
            }
            else
            {
                echo "Failed" ;
            }
        }
        else
        {
            echo "Failed" ;
        }

    }

    function sendUpdateLinksRequest($apiUrl, $cod, $uuid,$username,$password) {
        // Prepare the request data
        $requestData = [
            'action' => 'updateLinks',
            'movie_code' => $cod,
            'spl_uuid' => $uuid,
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

    function sendUnlinkSplRequest($apiUrl, $cod ,$username,$password) {
        // Prepare the request data
        $requestData = [
            'action' => 'unlinkMovie',
            'movie_code' => $cod,
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
        //print_r($response);

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
