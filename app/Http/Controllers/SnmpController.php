<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Error_list;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Snmp;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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

                    /*if(count($content) != $location->snmps->count() )
                    {
                        $snmp_ids = array_column($content, 'id_snmp');
                            foreach($location->snmps as $snmp)
                            {
                                if (! in_array( $snmp->id_snmp , $snmp_ids))
                                {
                                   $snmp->delete() ;
                                }
                            }
                    }*/

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
           // $snmps =Snmp::all();
            $snmps =Snmp::where('location_id',$location->id)->orderBy('id','DESC')->take(1000)->get();//dd($snmps);
            return Response()->json(compact('snmps','location'));
        }
        else
        {
            $snmps=null ;
            if( Auth::user()->role != 1)
            {
                $locations = Auth::user()->locations ;
            }
            else
            {
                $locations = Location::all() ;
            }
            return view('snmps.index', compact('snmps','locations'));
        }

    }
    public function get_snmp_with_map(Request $request )
    {

        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }

        $data_location = array() ;
        $states_red = array() ;
        $data_states = array() ;
        $states_green = array() ;
        //$errors = Snmp::with('location')->groupBy('locationcity')->get() ;
        //$locations = Location::groupBy('city')->get() ;

        $diskusage = false ;
        $playback_generale_status = false ;
        $securityManager = false  ;
        $schedules_error =false ;
        $missing_cpls = false ;
        $missing_kdms = false ;
        $infos ="" ;
        $count_diskusage = 0 ;
        $count_playback_generale_status = 0 ;
        $count_securityManager = 0 ;
        $count_missing_kdm_error = 0 ;
        $count_missing_cpl_error = 0  ;
        $playing_screen =  0;
        $offline_screen =  0;
        $idle_screen =  0;
        $pause_screen =  0;
        $count_unlinked_sessions_array= array();
        foreach($locations as $location )
        {
            //$infos ="<br /><h3 class='m-2'>Location : $location->name </h3>" ;
            $diskusage = false ;
            $playback_generale_status = false ;
            $schedules_error =false ;
            $missing_cpls = false ;
            $missing_kdms = false ;
            $securityManager = false  ;
            $count_diskusage = 0 ;
            $count_playback_generale_status = 0 ;
            $count_securityManager = 0 ;
            $count_missing_kdm_error = 0 ;
            $count_missing_cpl_error = 0 ;
            $count_unlinked_sessions = 0 ;

            if($location->diskusage->free_space_percentage >= 90  )
            {
                $diskusage = true ;
                //$infos =  " <p class='m-2'> Location : $location->name Disque Usage is : ".$location->diskusage->free_space_percentage." %  </p> " ;
                $count_diskusage ++ ;
            }
            foreach($location->playbacks as $playback)
            {

                if ($playback->playback_status == 'Stop')
                {
                    $idle_screen ++ ;
                }
                if ($playback->playback_status == 'Unknown' )
                {
                    $offline_screen ++ ;
                }
                if ($playback->playback_status == 'Play')
                {
                    $playing_screen ++ ;
                }
                if ($playback->playback_status == 'Pause')
                {
                    $pause_screen ++ ;
                }

                if($playback->storage_generale_status != 'Normal' )
                {
                    $playback_generale_status = true ;
                    $count_playback_generale_status ++ ;
                    if($playback->storage_generale_status == 'Red')
                    {
                        $storage_generale_status = "<span class='text-danger' > Storage Status  : Danger ! (used space >90%) </span>  |  Screen : " . $playback->serverName ;
                    }
                    elseif($playback->storage_generale_status == 'Yellow' || $playback->storage_generale_status == 'yellow')
                    {
                        $storage_generale_status = "<span class='text-warning' > Storage Status  : Warning ! (used space >80%) </span> |  Screen : " . $playback->serverName ;
                    }
                    elseif($playback->storage_generale_status == 'Error' )
                    {
                        $storage_generale_status = "Disk Space Quota" ;
                    }
                    else
                    {
                        //$storage_generale_status =$playback->storage_generale_status ;
                        $storage_generale_status ="" ;
                    }
                    //$infos .=  " <p class='m-2'> ".$storage_generale_status ." </p>";
                }

                if($playback->securityManager != 'Normal' )
                {
                    $securityManager = true ;
                    $count_securityManager ++ ;
                   //// $infos .=  " <p class='m-2'>Security Manager status is: ".$playback->securityManager ." in screen: " .$playback->screen->screen_name ." </p>";
                    //$infos .=  " <p class='m-2'>Security Manager status : Offline | Screen: " .$playback->screen->screen_name ." </p>";
                }
            }
            //$schedules = Schedule::where('location_id', $location->id )->where('date_start' , '>' , Carbon::today() )->groupBy('cod_film')->get() ;
            $schedules = Schedule::leftJoin('moviescods', 'schedules.cod_film', '=', 'moviescods.code')
            ->leftJoin('screens', 'schedules.screen_id', '=', 'screens.id')
            ->where('schedules.location_id', $location->id )
            ->where('schedules.date_start' , '>' , Carbon::today() )
           ->groupBy('schedules.scheduleId')
           ->orderBy('screens.id', 'ASC')
            ->orderBy('schedules.date_start', 'ASC')
            ->get() ;

            foreach($schedules as $schedule)
            {
                if($schedule->status != 'linked' && !$schedules_error )
                {
                    $schedules_error = true ;
                    //$infos .=  " <h4 class='m-2'>Unlinked Sessions Detected  </h4> " ;
                }
                if($schedule->status != 'linked' )
                {
                    //$infos .="<li>  session : ".$schedule->name." | Start : ".$schedule->date_start ;
                    $count_unlinked_sessions++ ;
                }

            }

            foreach($schedules as $schedule)
            {
                if($schedule->status == 'linked'  && $schedule->kdm != 1   &&  !$missing_kdms )
                {
                    $missing_kdms = true ;
                    //$infos .=  " <h4  class='m-2' > Missing KDMs Detected </h4> " ;
                }
                if($schedule->status == 'linked' && $schedule->kdm != 1)
                {
                    //$infos .="<li>  Session : ".$schedule->name." | Start At: ".$schedule->date_start ." | Screen : " . $schedule->screen_name;
                    $count_missing_kdm_error++;
                }
            }

            foreach($schedules as $schedule)
            {
                if($schedule->status == 'linked'  && $schedule->cpls != 1  &&  !$missing_cpls )
                {
                    $missing_cpls = true ;
                    //$infos .=  " <h4  class='m-2'> Missing CPLs Detected </h4> " ;
                }

                if( $schedule->status == 'linked'  && $schedule->cpls != 1 )
                {
                    $count_missing_cpl_error++ ;
                    //$infos .="<li>  session : ".$schedule->name." | Start At: ".$schedule->date_start ." | Screen : " . $schedule->screen_name;
                }
            }


            $error_maps = Error_list::with('location')->where('location_id',$location->id)->get() ;
            foreach($error_maps  as $error)
            {


                $infos =  " <h3 class='m-2'> Location : $location->name  </h3> " ;
                $infos .="<p class='d-flex'> " ;
                $infos .="<span class='m-3'> <i class='align-middle icon-md mdi mdi-key-remove  ml-auto'></i>  Kdms  : ".$error->kdm_errors." </span>";
                $infos .="<span class='m-3'> <i class='align-middle icon-md mdi mdi-calendar-today  ml-auto'></i>  Unlinked Sessions   : ".$count_unlinked_sessions." </span>";
                $infos .="<span class='m-3'> <i class='align-middle icon-md mdi mdi mdi-calendar-today  ml-auto'></i>  Server   : ".$error->nbr_server_alert." </span>";
                $infos .="<span class='m-3'> <i class='align-middle icon-md mdi mdi-projector  ml-auto'></i>  Projector  : ".$error->nbr_projector_alert." </span>";
                $infos .="<span class='m-3'> <i class='align-middle icon-md mdi mdi-volume-high ml-auto'></i> Sound   : 0 </span>";
                $infos .="<span class='m-3'> <i class='align-middle icon-md mdi mdi-chart-pie  ml-auto'></i> Storage  : ".$error->nbr_storage_errors." </span>";
                $infos .="</p> " ;

                if( $error->kdm_errors != 0  ||  $count_unlinked_sessions != 0  || $error->nbr_server_alert != 0  || $error->nbr_projector_alert != 0  || $error->nbr_storage_errors != 0  )
                {
                    array_push($data_location,  array("title" =>$location->name, "state" => $location->city , "location" => $location->name, "latitude" => $location->latitude, "longitude" => $location->longitude, "status" => "red" , "infos" =>$infos , "count_diskusage" =>$count_diskusage, "count_playback_generale_status" =>$count_playback_generale_status, "count_securityManager" =>$count_securityManager, "count_missing_kdm_error" =>$count_missing_kdm_error, "count_missing_cpl_error" =>$count_missing_cpl_error));
                    if (!in_array($location->city, $states_red))
                    {
                        array_push($states_red, $location->city);
                    }
                }
                else
                {
                    array_push($data_location,  array("title" =>$location->name, "state" => $location->city , "location" => $location->name, "latitude" => $location->latitude, "longitude" => $location->longitude, "status" => "green", "infos" => "No Errors Detected", "count_diskusage" =>$count_diskusage, "count_playback_generale_status" =>$count_playback_generale_status, "count_securityManager" =>$count_securityManager, "count_missing_kdm_error" =>$count_missing_kdm_error, "count_missing_cpl_error" =>$count_missing_cpl_error ));
                    if (!in_array($location->city, $states_green) && !in_array($location->city, $states_red))
                    {
                        array_push($states_green, $location->city);
                    }
                }

            }

            /*if( $diskusage || $playback_generale_status  || $schedules_error  || $securityManager && false)
            {
                array_push($data_location,  array("title" =>$location->name, "state" => $location->city , "location" => $location->name, "latitude" => $location->latitude, "longitude" => $location->longitude, "status" => "red" , "infos" =>$infos , "count_diskusage" =>$count_diskusage, "count_playback_generale_status" =>$count_playback_generale_status, "count_securityManager" =>$count_securityManager, "count_missing_kdm_error" =>$count_missing_kdm_error, "count_missing_cpl_error" =>$count_missing_cpl_error));
                if (!in_array($location->city, $states_red))
                {
                    array_push($states_red, $location->city);
                }
            }
            else
            {
                array_push($data_location,  array("title" =>$location->name, "state" => $location->city , "location" => $location->name, "latitude" => $location->latitude, "longitude" => $location->longitude, "status" => "green", "infos" => "No Errors Detected", "count_diskusage" =>$count_diskusage, "count_playback_generale_status" =>$count_playback_generale_status, "count_securityManager" =>$count_securityManager, "count_missing_kdm_error" =>$count_missing_kdm_error, "count_missing_cpl_error" =>$count_missing_cpl_error ));
                if (!in_array($location->city, $states_green) && !in_array($location->city, $states_red))
                {
                    array_push($states_green, $location->city);
                }
            }*/
            array_push($count_unlinked_sessions_array,  array("location_id" =>$location->id, "count" => $count_unlinked_sessions ));

        }
        foreach ($states_red as $state)
        {
            $content =""  ;
            foreach($data_location as $data)
            {
                if($state == $data['state'] && $data['status'] == 'red')
                {
                    $content .=  $data['infos'] ;
                }
            }
            array_push($data_states,  array("title" => $data['state'], "state" => $data['state'] , "location" => $location->name , "latitude" => $data['latitude'], "longitude" => $data['longitude'], "status" => "red", "infos" => $content ));
        }

        foreach ($states_green as $state)
        {
            $content = "No Errors Detected";
            foreach($data_location as $data)
            {
                if($state == $data['state'] && $data['status'] == 'green')
                {
                    //$content .=  $data['infos'] ;
                }
            }
            array_push($data_states,  array("title" => $data['state'], "state" => $data['state'] , "location" => $location->name , "latitude" => $data['latitude'], "longitude" =>$data['longitude'], "status" => "green", "infos" => $content ));
        }
        $error_table = Error_list::with('location')->get() ;

        $data = $request->data;
        $zoomLevel = $request->zoomLevel;

        if(isset($data) &&  $data != 'null' )
        {
            if($zoomLevel <= 8)
            {
                $data_count = $data_location;
                $data_location = $data_states ;

                return Response()->json(compact('data_location','data_count','error_table','locations','idle_screen','offline_screen','playing_screen','pause_screen','count_unlinked_sessions_array'));
            }
            else
            {
                $data_count = $data_location;
                return Response()->json(compact('data_location','locations','error_table','count_unlinked_sessions_array'));
            }
        }
        else
        {
            // Convert the array to JSON format
            $snmps=null ;

            return view('snmps.map', compact('snmps','locations'));
        }

    }


}
