<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Spl;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScheduleContoller extends Controller
{
    public function getschedules($location)
    {
            $location = Location::find($location) ;

            $url = $location->connection_ip."?request=getListSessionsScheduleFromNow";
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

                            $screen = Screen::where('screen_number', $schedule['number'])->first() ;
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


                                Schedule::updateOrCreate([
                                    'scheduleId' => $schedule["id"],
                                    'location_id' => $location->id,
                                ],[
                                   'name' => $schedule['name'],
                                   'scheduleId' => $schedule['id'],
                                   'titleShort' => $schedule['titleShort'],
                                   'uuid_spl' => $schedule['uuid_spl'],
                                   'screen_number' => $schedule['number'],
                                   //'duration' => $schedule['Lorem'],
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

                                ]);
                            }

                        }
                        $uuid_schedule = array_column($content, 'scheduleId');


                        foreach($location->schedules as $schedule)
                        {
                            if (! in_array( $schedule->scheduleId , $uuid_schedule) &&  strtotime($schedule->date_start) > strtotime('now')  )
                            {
                                $schedule->delete() ;
                            }
                        }

                            //dd('we should delete screens ') ;
                    }
                }
            }
            else
            {
                echo "no content <br />" ;
            }


    }

    public function get_schedules_with_filter(Request $request )
    {
        $location = $request->location;
        $screen = $request->screen;
        $date = $request->date;

        if($date)
        {
            $date = Carbon::createFromFormat('d/m/Y H', $date);
        }
        else
        {
            $date = Carbon::now();
        }
        //dd($schedules) ;



        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $schedules =Schedule::with('screen','spls')->where('location_id',$location->id)->get();

            $next_date = $date ;
            $schedules = $schedules->where('date_start','>',$date->addHours(3)->toDateTimeString())->where('date_start','<',$next_date->addHours(28)->toDateTimeString());

            if(isset($screen) && $screen != 'null' )
            {


                $schedules = $schedules->where('screen_id',$screen) ;

            }

            return Response()->json(compact('schedules','screens'));
        }
        else
        {

            if(isset($screen) && $screen != 'null' )
            {
                //$schedules = Screen::find($screen)->schedules ;
                $schedules =Schedule::with('screen','spls')->where('screen_id',$screen)->get();
                $next_date = $date ;
                $schedules = $schedules->where('date_start','>',$date->addHours(3)->toDateTimeString())->where('date_start','<',$next_date->addHours(28)->toDateTimeString());
                return Response()->json(compact('schedules'));
            }
            else
            {
                $locations = Location::all() ;
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

        $cpls_spl = $spl->cpls;

        $cpls_screen= $screen->cpls ;

        $missing_cpls = array();

        foreach($cpls_spl as $cpl_spl)
        {

            if($cpls_screen->contains($cpl_spl))
                {
                }
                else
                {
                    array_push($missing_cpls,array("uuid" => $cpl_spl->uuid, "contentTitleText" => $cpl_spl->contentTitleText, "playable" => $cpl_spl->playable) ) ;

                }


        }
        return Response()->json(compact('missing_cpls'));

    }


}
