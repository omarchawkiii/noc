<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Schedule;
use App\Models\Snmp;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SnmpController extends Controller
{
    public function getsnmp($location)
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=getSnmpErrors";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);
        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $snmp)
                    {
                        Snmp::updateOrCreate([
                            'id_snmp' => $snmp["id"],
                            'location_id' => $location->id,
                        ],[
                            'id_snmp'=> $snmp['id'],
                            'ip_address'=> $snmp['ip_address'],
                            'type'=> $snmp['type'],
                            'trap_data'=> $snmp['trap_data'],
                            'snmp_created_at'=> $snmp['created_at'],
                            'category'=> $snmp['category'],
                            'severity'=> $snmp['severity'],
                            'serverName'=> $snmp['serverName'],
                            'location_id' => $location->id ,
                        ]);
                    }
                }
            }
        }

    }

    public function get_snmp_with_filter(Request $request )
    {

        $location = $request->location;

        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $snmps =Snmp::all();
            $snmps =$snmps->where('location_id',$location->id);
            return Response()->json(compact('snmps','location'));
        }
        else
        {
            $snmps=null ;
            $locations = Location::all() ;
            return view('snmps.index', compact('snmps','locations'));
        }

    }
    public function get_snmp_with_map(Request $request )
    {

        $data_location = array() ;
        $states_red = array() ;
        $data_states = array() ;
        $states_green = array() ;
        //$errors = Snmp::with('location')->groupBy('locationcity')->get() ;
        //$locations = Location::groupBy('city')->get() ;
        $locations = Location::all() ;
        $diskusage = false ;
        $playback_generale_status = false ;
        $securityManager = false  ;
        $schedules_error =false ;
        $infos ="" ;
        foreach($locations as $location )
        {
            $infos ="" ;
            $diskusage = false ;
            $playback_generale_status = false ;
            $schedules_error =false ;
            $securityManager = false  ;

            if($location->diskusage->free_space_percentage >= 90  )
            {
                $diskusage = true ;
                $infos =  " <p>  Disque Usage is : ".$location->diskusage->free_space_percentage." % </p> " ;
            }

            foreach($location->playbacks as $playback)
            {
                if($playback->storage_generale_status != 'Normal' )
                {
                    $playback_generale_status = true ;
                    $infos .=  " <p> playback generale status is ".$playback->storage_generale_status ." in screen: " .$playback->screen->screen_name ." </p>";
                }

                if($playback->securityManager != 'Normal' )
                {
                    $securityManager = true ;
                    $infos .=  " <p> Security Manager status is: ".$playback->securityManager ." in screen: " .$playback->screen->screen_name ." </p>";
                }

            }




            $schedules = Schedule::where('location_id', $location->id )->where('date_start' , '>' , Carbon::today() )->where('date_start' , '<' , Carbon::now()->addDays(1) )->get() ;

            foreach($schedules as $schedule)
            {
                if(($schedule->status != 'linked'  || ($schedule->kdm != 1 || $schedule->cpls != 1 )) &&  !$schedules_error )
                {
                    $schedules_error = true ;
                    $infos .=  " <p> Missing KDMs </p> " ;

                }
                if(($schedule->status != 'linked'  || ($schedule->kdm != 1 || $schedule->cpls != 1 )) )
                {
                    $schedules_error = true ;
                    $infos .="<li>  session : ".$schedule->name." Has problem  </li> ";
                }
            }

            if( $diskusage || $playback_generale_status  || $schedules_error  || $securityManager)
            {
                array_push($data_location,  array("state" => $location->city , "location" => $location->name, "latitude" => $location->latitude, "longitude" => $location->longitude, "status" => "red" , "infos" =>$infos));
                if (!in_array($location->city, $states_red))
                {
                    array_push($states_red, $location->city);
                }

            }
            else
            {
                if (!in_array($location->city, $states_green) && !in_array($location->city, $states_red))
                {
                    array_push($states_green, $location->city);
                }
                array_push($data_location,  array("state" => $location->city , "location" => $location->name, "latitude" => $location->latitude, "longitude" => $location->longitude, "status" => "green", "infos" => "No Errors " ));
            }



        }


        foreach ($states_red as $state)
        {
            $content = "" ;
            foreach($data_location as $location)
            {
                if($state == $location['state'] && $location['status'] == 'red')
                {
                    $content .=  $location['infos'] ;
                }

            }

            array_push($data_states,  array("state" => $location['state'] , "location" => $state , "latitude" => $location['latitude'], "longitude" => $location['longitude'], "status" => "red", "infos" => $content ));
        }

        foreach ($states_green as $state)
        {
            $content = "" ;
            foreach($data_location as $location)
            {
                if($state == $location['state'] && $location['status'] == 'green')
                {
                    $content .=  $location['infos'] ;
                }
            }
            array_push($data_states,  array("state" => $location['state'] , "location" => $state , "latitude" => "4.155672", "longitude" => "100.569649", "status" => "green", "infos" => $content ));
        }





        $data = $request->data;
        $zoomLevel = $request->zoomLevel;

        if(isset($data) &&  $data != 'null' )
        {

            if($zoomLevel <= 8)
            {
                $data_location = $data_states ;
                return Response()->json(compact('data_location'));
            }
            else
            {
                return Response()->json(compact('data_location'));
            }
        }
        else
        {
            // Convert the array to JSON format
            $snmps=null ;
            $locations = Location::all() ;
            return view('snmps.map', compact('snmps','locations'));
        }

    }

}
