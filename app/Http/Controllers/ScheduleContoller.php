<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Schedule;
use App\Models\Spl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScheduleContoller extends Controller
{
    public function getschedules($location, $spl)
    {


        //$spl_content = Spl::where('uuid',$spl)->first() ;
        $spl_content = Spl::where('uuid', '=', $spl)->first();
        if($spl_content)
        {
            $location = Location::find($location) ;

            $url = $location->connection_ip."?request=getCplListByScreenNumber&screen_number=".$spl;
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);
            echo "url : $url <br />" ;
            if($contents)
            {
                foreach($contents as $content)
                {
                    if($content)
                    {
                        foreach($content as $schedule)
                        {
                            Schedule::updateOrCreate([
                                'scheduleId' => $schedule["scheduleId"],
                                'location' => $location->id,
                            ],[
                                "scheduleId" => $schedule['scheduleId'],
                                "screen_number" => $schedule['screen_number'],
                                "date_start" => $schedule['date_start_string_format'],
                                "date_end" => $schedule['date_end_string_format'],
                                "duration" => $schedule['duration'],
                                "cod_film" => $schedule['cod_film'],
                                "id_film" => $schedule['id_film'],
                                "color" => $schedule['color'],
                                "type" => $schedule['type'],
                                "spl_uuid" => $spl,
                                "screen_name" => $schedule['screen_name'],
                            ]);
                        }

                        if(count($content) != $spl_content->schedules->count() )
                        {
                            $uuid_schedule = array_column($content, 'scheduleId');
                                foreach($spl_content->schedules as $schedul)
                                {
                                    if (! in_array( $schedul->scheduleId , $uuid_schedule))
                                    {
                                        $schedul->delete() ;
                                    }
                                }

                            //dd('we should delete screens ') ;
                        }
                    }
                }
            }
            else
            {
                echo "no content <br />" ;
            }
           // return Redirect::back()->with('message' ,' The schedules  has been updated');
        }
    }
}
