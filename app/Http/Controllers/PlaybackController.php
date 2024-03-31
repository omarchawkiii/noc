<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Playback;
use App\Models\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaybackController extends Controller
{
    public function getplayback($location)
    {
        $location = Location::find($location) ;
        //$url ="http://localhost/tms/system/api2.php?request=getPlaybackStatus";

        $url = $location->connection_ip."?request=getPlaybackStatus";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);
        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $playback)
                    {
                        $screen = Screen::where('id_server', $playback['id_server'])->first() ;
                        Playback::updateOrCreate([
                            'id_server' => $playback["id_server"],
                            'location_id' => $location->id,
                        ],[
                            'id_server' => $playback['id_server'] ,
                            'serverName' => $playback['serverName'] ,
                            'playback' => $playback['playback'] ,
                            'managment_ip' => $playback['managment_ip'] ,
                            'usernameAdmin' => $playback['usernameAdmin'] ,
                            'passwordAdmin' => $playback['passwordAdmin'] ,
                            'serverType' => $playback['serverType'] ,
                            'storage_configuration' => $playback['storage_configuration'] ,
                            'storage_ip' => $playback['storage_ip'] ,
                            'enable_power_control' => $playback['enable_power_control'] ,
                            'projector_ip' => $playback['projector_ip'] ,
                            'sound_ip' => $playback['sound_ip'] ,
                            'id_auditorium' => $playback['id_auditorium'] ,
                            'number_auditorium' => $playback['number_auditorium'] ,
                            'sound_model' => $playback['sound_model'] ,
                            'ip_management_server_status' => $playback['ip_management_server_status'] ,
                            'storage_generale_status' => $playback['storage_generale_status'] ,
                            'schedule_mode' => $playback['schedule_mode'] ,
                            'hardware' => $playback['hardware'] ,
                            'securityManager' => $playback['securityManager'] ,
                            'total_server_status' => $playback['total_server_status'] ,
                            'schedule_generale_status' => $playback['schedule_generale_status'] ,
                            'projector_status' => $playback['projector_status'] ,
                            'projector_lamp_stat' => $playback['projector_lamp_stat'] ,
                            'spl_title' => $playback['spl_title'] ,
                            'cpl_title' => $playback['cpl_title'] ,
                            'playback_status' => $playback['playback_status'] ,
                            'elapsed_runtime' => $playback['elapsed_runtime'] ,
                            'remaining_runtime' => $playback['remaining_runtime'] ,
                            'progress_bar' => $playback['progress_bar'] ,
                            'lamp_status' => $playback['lamp_status'] ,
                            'dowser_status' => $playback['dowser_status'] ,

                            'screen_id' => $screen->id ,
                            'location_id' => $location->id ,

                            'ip_sound_status' => $playback['ip_sound_status'] ,
                            'sound_status' => $playback['sound_status'] ,


                        ]);
                    }
                }
            }
        }

    }

    public function index()
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::orderBy('name', 'DESC')->get() ;
        }
        return view('playbacks.index', compact('locations'));
    }

    public function get_playbak_detail(Request $request)
    {
        $playback = Playback::find($request->id) ;
        $screen_info = Screen::where('id',$playback->screen_id)
        ->select('screens.screen_name')->first() ;

        return Response()->json(compact('playback' , 'screen_info' ));

    }
}
