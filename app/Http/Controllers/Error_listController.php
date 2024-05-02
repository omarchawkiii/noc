<?php

namespace App\Http\Controllers;

use App\Models\Error_list;
use App\Models\Kdm_error_list;
use App\Models\Location;
use App\Models\Server_error_list;
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
            Server_error_list::all()->delete();

            if( count($contents['errors_list']['list_server_errors']) > 0 )
            {
                foreach($contents['errors_list']['list_server_errors'] as $list_server_error)
                {
                    Server_error_list::updateOrCreate([
                        'id_sever_error' => $list_server_error['id'] ,
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

            Kdm_error_list::all()->delete();

            if( count($contents['errors_list']['list_kdm_errors']) > 0 )
            {
                foreach($contents['errors_list']['list_kdm_errors'] as $list_kdm_error)
                {
                    Kdm_error_list::all()->delete();
                    Kdm_error_list::updateOrCreate([
                        'location_id' => $location->id
                    ],[

                        'annotationText' => $list_kdm_error['AnnotationText'],
                        'cpl_id' => $list_kdm_error['cpl_id'],
                        'date_time' => $list_kdm_error['date_time'],
                        'details' => $list_kdm_error['errorCode'],
                        'screen_id' => $list_kdm_error['screen_id'],
                        'serverName' => $list_kdm_error['serverName'],
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
        $kdms_errors_list = Kdm_error_list::where('location_id',$location)->get() ;
        return Response()->json(compact('kdms_errors_list'));
    }

    public function server_errors_list(Request $request)
    {
        $location = $request->location;
        $server_errors_list = Server_error_list::where('location_id',$location)->get() ;
        return Response()->json(compact('server_errors_list'));
    }
}
