<?php

namespace App\Http\Controllers;

use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\splcomponents;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LmssplController extends Controller
{
    public function getlmsspls( $location )
    {

        $location = Location::find($location) ;
        $url = $location->connection_ip . "?request=getLmsSplList";
       // echo "URL : " . $url . " <br />" ;
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
                        foreach($content as $lmsspl)
                        {
                            Lmsspl::updateOrCreate([
                                'uuid' => $lmsspl["uuid"],
                                'location_id'     =>$location->id,
                            ],[
                                'uuid'     => $lmsspl["uuid"],
                                'name'     => $lmsspl["title"],
                                'duration'     => gmdate("H:i:s", $lmsspl["duration"]) ,
                                'available_on'     => $lmsspl["available_on"],
                                'location_id'     =>$location->id,
                            ]);
                        }
                        // check if SPLs deleted
                        if(count($content) != $location->lmsspls->count() )
                        {
                            $uuid_lmsspls = array_column($content, 'uuid');
                            foreach($location->lmsspls as $lmsspl)
                            {
                                if (! in_array( $lmsspl->uuid , $uuid_lmsspls))
                                {
                                    // delete deleted screen
                                    $lmsspl->delete() ;
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
    }

    public function get_lmsspl_infos($spl )
    {

        $spl = Lmsspl::find($spl) ;
      //  $schedules =  $spl->schedules ;
        //$schedules =Schedule::with('screen')->where('uuid_spl',$spl->uuid)->where('location_id',$spl->location_id)->get();



        //$cpls = $spl->lmscpls ;
        $cpls = splcomponents::where('uuid_spl',$spl->uuid)->where('location_id',$spl->location_id)->get() ;
      //  $schedules =  $spl->schedules ;
        //$schedules =null ; //Schedule::with('screen')->where('spl_id',$spl->id)->get();
        $schedules =Schedule::with('screen')->where('uuid_spl',$spl->uuid)->where('date_start' , '>' , Carbon::today() )->where('location_id',$spl->location_id)->get();
        return Response()->json(compact('spl','cpls','schedules'));
    }
}
