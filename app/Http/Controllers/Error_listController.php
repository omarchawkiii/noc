<?php

namespace App\Http\Controllers;

use App\Models\Error_list;
use App\Models\Kdm_error_list;
use App\Models\Location;
use App\Models\Projector_errors_list;
use App\Models\Schedule;
use App\Models\Server_error_list;
use App\Models\Storage_errors_list;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Error_listController extends Controller
{
    public function get_error_list($location )
    {

        $location = Location::find($location) ;
        $url = $location->connection_ip . "?request=get_errors_list";

        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {

            Error_list::updateOrCreate([
                'location_id' => $location->id
            ],[

                'kdm_errors' => $contents['errors_list']['kdm_errors'],
                'nbr_sound_alert' => $contents['errors_list']['nbr_sound_alert'],
                'nbr_projector_alert' => $contents['errors_list']['nbr_projector_alert'],
                'nbr_server_alert' => $contents['errors_list']['nbr_server_alert'],
                'nbr_storage_errors' => $contents['errors_list']['nbr_storage_errors'],
                'location_id' => $location->id,
            ]);
            Server_error_list::where('location_id',$location->id)->delete();

            if( $contents['errors_list']['list_server_errors'] )
            {
                foreach($contents['errors_list']['list_server_errors'] as $list_server_error)
                {

               // dd($contents['errors_list']['list_server_errors']);
                    Server_error_list::updateOrCreate([
                        'id_server_error' => $list_server_error['id'] ,
                        'location_id' => $location->id
                    ],[

                        'class' => $list_server_error['class'],
                        'criticity' => $list_server_error['criticity'],
                        'date' => $list_server_error['date'],
                        'errorCode' => $list_server_error['errorCode'],
                        'eventId' => $list_server_error['eventId'],
                        'id_sever_error' => $list_server_error['id'],
                        'id_screen' => $list_server_error['id_screen'],
                        'number' => $list_server_error['number'],
                        'serverName' => $list_server_error['serverName'],
                        'subType' => $list_server_error['subType'],
                        'type' => $list_server_error['type'],
                        'location_id' => $location->id,
                    ]);
                }
            }

            Kdm_error_list::where('location_id',$location->id)->delete();

            if( $contents['errors_list']['list_kdm_errors'] )
            {
                foreach($contents['errors_list']['list_kdm_errors'] as $list_kdm_error)
                {

                    Kdm_error_list::updateOrCreate([
                        'location_id' => $location->id,
                        'cpl_id' => $list_kdm_error['cpl_id'],
                        'screen_id' => $list_kdm_error['screen_id'],
                    ],[

                        'annotationText' => $list_kdm_error['AnnotationText'],
                        'cpl_id' => $list_kdm_error['cpl_id'],
                        'date_time' => $list_kdm_error['date_time'],
                        'details' => $list_kdm_error['details'],
                        'screen_id' => $list_kdm_error['screen_id'],
                        'serverName' => $list_kdm_error['serverName'],
                        'location_id' => $location->id,
                    ]);
                }
            }

            Projector_errors_list::where('location_id',$location->id)->delete();

            if( $contents['errors_list']['list_projector_errors'] )
            {
                foreach($contents['errors_list']['list_projector_errors'] as $projector_error)
                {

                    Projector_errors_list::updateOrCreate([
                        'location_id' => $location->id,
                        'id_projector_errors' => $projector_error['id'],
                    ],[
                        'code' => $projector_error['code'],
                        'id_projector_errors' => $projector_error['id'],
                        'id_screen' => $projector_error['id_screen'],
                        'ip_projector' => $projector_error['ip_projector'],
                        'message' => $projector_error['message'],
                        'number' => $projector_error['number'],
                        'serverName' => $projector_error['serverName'],
                        'severity' => $projector_error['severity'],
                        'time_saved' => $projector_error['time_saved'],
                        'title' => $projector_error['title'],
                        'location_id' => $location->id,
                    ]);
                }
            }

            Storage_errors_list::where('location_id',$location->id)->delete();

            if( $contents['errors_list']['list_storage_errors'] )
            {
                foreach($contents['errors_list']['list_storage_errors'] as $projector_error)
                {
                    Storage_errors_list::create([
                        'screen_number' => $projector_error['screen_number'],
                        'storage_generale_status' => $projector_error['storage_generale_status'],
                        'serverName' => $projector_error['serverName'],
                        'location_id' => $location->id,
                    ]);
                }
            }

        }
        return Redirect::back()->with('message' ,' The Errors list  has been updated');
    }

    public function header_errors()
    {
        $error_tables = Error_list::all() ;

        $kdm_errors  = 0 ;
        $nbr_sound_alert  = 0 ;
        $nbr_projector_alert  = 0 ;
        $nbr_server_alert  = 0 ;
        $nbr_storage_errors  = 0 ;

        foreach($error_tables as $error_table)
        {
            $kdm_errors += $error_table->kdm_errors  ;
            $nbr_sound_alert += $error_table->nbr_sound_alert  ;
            $nbr_projector_alert += $error_table->nbr_projector_alert  ;
            $nbr_server_alert += $error_table->nbr_server_alert  ;
            $nbr_storage_errors += $error_table->nbr_storage_errors  ;

        }

        $total_errors = $kdm_errors  + $nbr_sound_alert  + $nbr_projector_alert  + $nbr_server_alert  + $nbr_storage_errors  ;
        return Response()->json(compact('kdm_errors','nbr_sound_alert','nbr_projector_alert','nbr_server_alert','nbr_storage_errors','total_errors'));

    }

    public function kdms_errors_list(Request $request)
    {
        $location = $request->location;
        if($location)
        {
            $kdms_errors_list = Kdm_error_list::with('location')->where('location_id',$location)->get() ;
        }
        else
        {
            $kdms_errors_list = Kdm_error_list::with('location')->get() ;
        }

        return Response()->json(compact('kdms_errors_list'));
    }

    public function server_errors_list(Request $request)
    {
        $location = $request->location;

        if($location)
        {
            $server_errors_list = Server_error_list::with('location')->where('location_id',$location)->get() ;
        }
        else
        {
            $server_errors_list = Server_error_list::with('location')->get() ;
        }


        return Response()->json(compact('server_errors_list'));
    }

    public function projector_errors_list(Request $request)
    {
        $location = $request->location;

        if($location)
        {
            $projector_errors_list = Projector_errors_list::with('location')->where('location_id',$location)->get() ;
        }
        else
        {
            $projector_errors_list = Projector_errors_list::with('location')->get() ;
        }

        return Response()->json(compact('projector_errors_list'));
    }

    public function storage_errors_list(Request $request)
    {
        $location = $request->location;

        if($location)
        {
            $storage_errors_list = Storage_errors_list::with('location')->where('location_id',$location)->get() ;
        }
        else
        {
            $storage_errors_list = Storage_errors_list::with('location')->get() ;
        }

        return Response()->json(compact('storage_errors_list'));
    }

    public function get_unlinked_sessions_errors_list(Request $request)
    {
        $schedules = Schedule::leftJoin('moviescods', 'schedules.cod_film', '=', 'moviescods.code')
            ->leftJoin('screens', 'schedules.screen_id', '=', 'screens.id')
            ->where('schedules.location_id', $request->location )
            ->where('schedules.status','!=','linked' )
            ->where('schedules.date_start' , '>' , Carbon::today() )
           ->groupBy('schedules.scheduleId')
           ->orderBy('screens.id', 'ASC')
            ->orderBy('schedules.date_start', 'ASC')
            ->get() ;

        return Response()->json(compact('schedules'));
    }
}
