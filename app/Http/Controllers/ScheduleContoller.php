<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use App\Models\splcomponents;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ScheduleContoller extends Controller
{
    public function getschedules($location)
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=getListSessionsScheduleFromNow";
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
                        foreach($content as $schedule)
                        {
                            if( isset($schedule['cpls']))
                            {
                                $cpls = $schedule['cpls'] ;
                            }
                            else
                            {
                                $cpls = null ;
                            }

                            if( isset($schedule['kdm']))
                            {
                                $kdm = $schedule['kdm'] ;
                            }
                            else
                            {
                                $kdm = null ;
                            }

                            $screen = Screen::where('screen_number', $schedule['number'])->where('location_id', $location->id)->first() ;
                            if($screen)
                            {
                                if( $schedule['status'] != "linked" || $schedule['uuid_spl'] == 'null'  )
                                {
                                    $spl_id =null ;
                                }
                                else
                                {
                                    $spl = Spl::where('uuid',$schedule['uuid_spl'])->first() ;
                                    if($spl )
                                    {
                                        $spl_id = $spl->id ;
                                    }
                                    else
                                    {
                                        $spl_id =null ;
                                    }
                                }
                                $kdm_status="";
                                $disable_kdm_not_valide =false ;
                                if(count($schedule['list_kdm_notes']) > 0 )
                                {
                                    foreach($schedule['list_kdm_notes'] as $kdm_note )
                                    {
                                        foreach($kdm_note['list_not'] as $note)
                                        {
                                            if($note['status'] == 'valid')
                                            {
                                                $disable_kdm_not_valide = true ;
                                            }
                                        }
                                    }

                                    foreach($schedule['list_kdm_notes'] as $kdm_note )
                                    {
                                        foreach($kdm_note['list_not'] as $note)
                                        {
                                            if($note['status'] == 'valid')
                                            {
                                                $kdm_status .= '<a class="btn btn-success btn-fw mr-1" >KDM Expired in : ' .$note['date_expired'].' </a>';
                                            }
                                            elseif($note['status'] == 'not_valid_yet')
                                            {
                                                $kdm_status .= '<a class="btn btn-light  btn-fw mr-1" > KDM Valid After : ' .$note['date_start_valid'].' </a>';
                                            }
                                            elseif($note['status'] == 'warning')
                                            {
                                                $kdm_status .= '<a class="btn btn-warning btn-fw mr-1" >KDM Expired in : ' .$note['date_expired'].' </a>';
                                            }
                                            else
                                            {
                                                if(!$disable_kdm_not_valide)
                                                {
                                                    $kdm_status .= '<a class="btn btn-danger btn-fw mr-1">KDM Already Expired : ' .$note['date_expired'].'</a>';
                                                }

                                            }
                                            $date_expired ="";
                                        }
                                    }
                                    /*$kdm_status = $schedule['list_kdm_notes'][0]['list_not'][0]['status'] ;
                                    $date_expired = $schedule['list_kdm_notes'][0]['list_not'][0]['date_expired'] ;
                                            */

                                }
                                else
                                {
                                    $kdm_status ="";
                                    $date_expired ="";
                                }
                                Schedule::updateOrCreate([
                                    'scheduleId' => $schedule["id"],
                                    'location_id' => $location->id,
                                ],[
                                    'name' => $schedule['name'],
                                    'scheduleId' => $schedule['id'],
                                    'titleShort' => $schedule['titleShort'],
                                    'uuid_spl' => $schedule['uuid_spl'],
                                    'screen_number' => $schedule['number'],
                                    'cod_film' => $schedule['cod_film'],
                                    'id_film' => $schedule['id_film'],
                                    'color' => $schedule['color'],
                                    'date_start' => $schedule['start'],
                                    'date_end' => $schedule['end'],
                                    'type' => $schedule['type'],
                                    'status' => $schedule['status'],
                                    'cpls' => $cpls,
                                    'kdm' => $kdm,
                                    "idserver" =>  $schedule['idserver'],
                                    'ShowTitleText' => $schedule['ShowTitleText'],
                                    'spl_available' => $schedule['spl_available'],
                                    'screen_id' => $screen->id ,
                                    'spl_id' => $spl_id ,
                                    'location_id' => $location->id ,
                                    'kdm_status' => $kdm_status,
                                    'date_expired' => $date_expired,
                                ]);
                            }

                        }
                        $uuid_schedule = array_column($content, 'id');
                        $schedules = Schedule::where('location_id',$location->id)->where('date_start','>',Carbon::now('Asia/Kuala_Lumpur'))->get();

                        foreach($schedules as $schedule)
                        {
                            if (! in_array( $schedule->scheduleId , $uuid_schedule  ))
                            {
                                $schedule->delete() ;
                            }
                        }
                    }
                }
            }
        }
        catch (RequestException $e) {
            // Log de l'erreur ou traitement spécifique
            echo " message: " . $e->getMessage();
        }
        catch (\Exception $e) {
            // Capture d'autres exceptions générales
            echo " message: " . $e->getMessage();
           // return Redirect::back()->with('error', 'Unexpected error for location: ' . $location->id);
        }
    }
    public function get_schedules_with_filter(Request $request )
    {
        $location = $request->location;
        $screen = $request->screen;
        $date = $request->date;
        $setting = Config::all()->first() ;
        $setting_schedule_timeStart = "Y-m-d ".$setting->timeStart.":00" ;
        $setting_schedule_timeEnd = "Y-m-d ".$setting->timeEnd.":00" ;
        //dd( $date) ;
        if($date)
        {
            $date = Carbon::createFromFormat('d/m/Y H', $date);
            if($date->isToday() &&false )
            {
                $current_datetime = date('Y-m-d H:i:s');
                if (date('H', strtotime($current_datetime)) >= 5 || true ) {
                    // If the current time is after 5 AM, consider it as the start of the day
                    $startDate = date("$setting_schedule_timeStart", strtotime($current_datetime));
                    $nextDayStart = date("$setting_schedule_timeEnd", strtotime('+1 day', strtotime($current_datetime)));
                } else {
                    // If the current time is before 5 AM, consider it as the end of the previous day
                    $startDate = date("$setting_schedule_timeStart", strtotime('-1 day', strtotime($current_datetime)));
                    $nextDayStart = date("$setting_schedule_timeEnd", strtotime($current_datetime));
                }

                //dd($startDate , $nextDayStart) ;
            }
            else
            {

                $startDate = date("$setting_schedule_timeStart", strtotime($date));
                $nextDayStart = date("$setting_schedule_timeEnd", strtotime('+1 day', strtotime($date)));
                //$nextDayStart = date("$setting_schedule_timeEnd", strtotime('-01 seconds', strtotime($nextDayStart)));
                //dd($startDate , $nextDayStart) ;
            }
        }
        else
        {
            $date = Carbon::now();
        }


        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $schedules =Schedule::with('screen','spls')->where('location_id',$location->id) ;
                /*$schedules = DB::table('schedules')
                ->where('schedules.location_id',$location->id)
                ->leftJoin('screens', 'schedules.screen_id', '=', 'screens.id')
                ->leftJoin('spls', 'schedules.uuid_spl', '=', 'spls.uuid')
                ->leftJoin('splcomponents', 'splcomponents.uuid_spl', '=', 'spls.uuid')
                ->leftJoin('kdms', 'splcomponents.CompositionPlaylistId', '=', 'kdms.uuid')
                ->groupBy('schedules.scheduleId');
            */

            $next_date = $date ;


            $schedules = $schedules->where('date_start','>=',$startDate)->where('date_start','<',$nextDayStart);
            //dd($startDate , $nextDayStart,$schedules->get()) ;
            if(isset($screen) && $screen != 'null' )
            {
                $schedules = $schedules->where('schedules.screen_id',$screen) ;
            }
            $schedules = $schedules->orderBy('schedules.screen_id')->orderBy('schedules.date_start')->get();

            return Response()->json(compact('schedules','screens'));
        }
        else
        {
            if(isset($screen) && $screen != 'null' )
            {
                //$schedules = Screen::find($screen)->schedules ;
                $schedules =Schedule::with('screen','spls')->where('screen_id',$screen);
                $next_date = $date ;
                $schedules = $schedules->where('date_start','>=',$startDate)->where('date_start','<',$nextDayStart);
                $schedules = $schedules->orderBy('screen_id')->orderBy('date_start')->get();
                return Response()->json(compact('schedules'));
            }
            else
            {
                if( Auth::user()->role != 1)
                {
                    $locations = Auth::user()->locations ;
                }
                else
                {
                    $locations = Location::all() ;
                }
                $schedules =null ;
                $screens = null ;
                return view('schedules.index', compact('screen','screens','locations'));
            }
        }

    }

    public function get_unlinked_spl(Request $request)
    {
        $schedule = Schedule::where('id',  $request->schedule_idd)->first() ;
        $screen = $schedule->screen ;
        //dd($schedule, $schedule->uuid_spl ,$schedule->location_id,$schedule->screen_id) ;
        $spl = Spl::where('uuid',$schedule->uuid_spl)->where('screen_id',$schedule->screen_id)->where('location_id',$schedule->location_id)->first() ;
        $cpls_from_splcomponent = splcomponents::where('uuid_spl',$spl->uuid)->where('location_id',$schedule->location_id)->get() ;
        //$cpls_spl = $spl->cpls;
        $cpls_screen= $screen->cpls ;
        $missing_cpls = array();
        $unplayable_cpls = array();
        //$location = $schedule->location ;
        //dd($cpls_screen) ;

        foreach($cpls_from_splcomponent as $cpl_from_splcomponent)
        {
            $cpl = Cpl::where('uuid',$cpl_from_splcomponent->CompositionPlaylistId)->where('location_id',$schedule->location_id)->first() ;

            if($cpl == null)
            {
                array_push($missing_cpls,array("uuid" => $cpl_from_splcomponent->CompositionPlaylistId, "contentTitleText" => $cpl_from_splcomponent->AnnotationText, "playable" => 1) ) ;

            }
            else
            {
                if($cpl->playable != 1)
                {
                    array_push($unplayable_cpls,array("uuid" => $cpl->uuid, "contentTitleText" => $cpl->contentTitleText, "playable" => $cpl->playable) ) ;
                }
            }
        }
        return Response()->json(compact('missing_cpls','unplayable_cpls'));

    }

    public function get_need_kdm(Request $request)
    {
        $schedule = Schedule::where('id',  $request->schedule_idd)->first() ;
        $screen = $schedule->screen ;
        //dd($schedule, $schedule->uuid_spl ,$schedule->location_id,$schedule->screen_id) ;
        $spl = Spl::where('uuid',$schedule->uuid_spl)->where('screen_id',$schedule->screen_id)->where('location_id',$schedule->location_id)->first() ;

       // $cpls_spl = $spl->cpls;
        $cpls_spl = splcomponents::where('uuid_spl',$spl->uuid)->where('location_id',$schedule->location_id)->get() ;

        $cpls_screen= $screen->cpls ;
        $missing_kdms = array();

        foreach($cpls_spl as $cpl_spl)
        {
            $cpl_screen = Cpl::where('uuid',$cpl_spl->CompositionPlaylistId)->where('screen_id', $screen->id)->where('location_id', $schedule->location_id)->first();

            if($cpl_screen != null )
            {
                if($cpl_screen->pictureEncryptionAlgorithm != "None")
                {
                    $kdm = Kdm::where('cpl_id',$cpl_screen->id)->where('screen_id', $screen->id )->get() ;

                    if($kdm->count() ==0)
                    {
                        array_push($missing_kdms,array("uuid" => $cpl_screen->uuid, "contentTitleText" => $cpl_screen->contentTitleText, "playable" => $cpl_screen->playable) ) ;
                    }
                }
            }
        }
        return Response()->json(compact('missing_kdms'));

    }


    public function get_schedule_infos(Request $request)
    {
        $cpls_with_kdms=array() ;
        $schedule = Schedule::with('screen')->where('id',  $request->schedule_idd)->where('location_id',$request->location )->first() ;

        $spl = Spl::where('uuid',$schedule->uuid_spl)->where('screen_id',$schedule->screen_id)->where('location_id',$schedule->location_id)->first() ;

        if($spl)
        {
            $cpls_from_splcomponent = splcomponents::where('uuid_spl',$spl->uuid)->where('location_id',$spl->location_id)->groupBy('CompositionPlaylistId')->orderBy('uuid_spl')->get() ;
            foreach($cpls_from_splcomponent as $cpl_from_splcomponent)
            {
                $cpl = Cpl::where('uuid',$cpl_from_splcomponent->CompositionPlaylistId)->where('location_id',$schedule->location_id)->where('screen_id',$schedule->screen_id)->first() ;
                $kdm_infos = array() ;
                if($cpl == null)
                {
                    $cpl_present = "<spna class='text-danger' >No </span>" ;
                    $cpl_playable = "<spna class='text-danger' > No </span>" ;
                }

                else
                {
                    $cpl_present = "<spna class='text-success' >Yes </span>" ;
                    if($cpl->playable != 1)
                    {
                        $cpl_playable = "<spna class='text-danger' > No </span>" ;
                    }
                    else
                    {
                        $cpl_playable = "<spna class='text-success' >Yes </span>" ;
                    }
                }

                if($cpl != null )
                {
                    if($cpl->pictureEncryptionAlgorithm != "None")
                    {
                        $kdm = Kdm::where('cpl_uuid',$cpl->uuid)->where('screen_id', $schedule->screen_id )->first() ;

                        if(!$kdm)
                        {
                            $kdm_response = "<spna class='text-danger' > KDM Missing </span>" ;
                        }
                        else
                        {

                            $kdm_status="" ;
                            if($schedule->kdm_status =="not_valid_yet")
                            {
                                $kdm_status = '<button  type="button" class="btn btn-warning btn-fw get_schedule_infos"> KDM Valide in :  '.$schedule->date_expired.'</button>' ;
                            }
                            if($schedule->kdm_status =="expired")
                            {
                                $kdm_status = '<button type="button" class="btn btn-danger get_schedule_infos  btn-fw"> KDM Already Expired : '.$schedule->date_expired.'</button>';
                            }
                            if($schedule->kdm_status =="warning")
                            {
                                $kdm_status = '<button type="button" class="btn btn-warning get_schedule_infos btn-fw">KDM Expired in : '.$schedule->date_expired.'</button>';
                            }
                            if($schedule->kdm_status =="valid")
                            {
                                $kdm_status = '<button type="button" class="btn btn-success get_schedule_infos btn-fw"> KDM Expired in  : '.$schedule->date_expired.'</button>';
                            }

                            $kdm_response = "KDM Available" ;
                            $kdm_infos ['kdm_uuid'] = $kdm->uuid ;
                            $kdm_infos ['device_target'] = $kdm->device_target ;
                            //  $kdm_infos ['ContentKeysNotValidBefore'] = $kdm->ContentKeysNotValidBefore ;
                            $kdm_infos ['kdm_status'] = $kdm_status ;
                        }
                    }
                    else
                    {
                        $kdm_response = "Non Encrypted" ;
                    }
                    array_push($cpls_with_kdms,array("title" => $cpl->contentTitleText, "cpl_present" => $cpl_present , "cpl_playable" => $cpl_playable , "cpl_uuid" => $cpl->uuid , "available_on" => $cpl->available_on , "kdm" => $kdm_response , 'kdm_infos' =>$kdm_infos) ) ;
                }
                else
                {
                    $cpl = Cpl::where('uuid',$cpl_from_splcomponent->CompositionPlaylistId)->where('location_id',$schedule->location_id)->first() ;
                    if($cpl != null)
                    {
                        $available_on  = $cpl->available_on ;
                    }
                    else
                    {
                        $available_on = '';
                    }
                    array_push($cpls_with_kdms,array("title" => $cpl_from_splcomponent->AnnotationText, "cpl_present" => $cpl_present , "cpl_playable" => $cpl_playable , "cpl_uuid" => $cpl_from_splcomponent->CompositionPlaylistId , "available_on" => $available_on , "kdm" => "Unknown" , 'kdm_infos' =>"") ) ;
                }



            }
        }
        else
        {
            $cpls_with_kdms = null ;
            $spl =null ;
        }

        return Response()->json(compact('cpls_with_kdms', 'spl' , 'schedule'));
    }

}
