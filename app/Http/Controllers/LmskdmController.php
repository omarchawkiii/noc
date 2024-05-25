<?php

namespace App\Http\Controllers;

use App\Models\Lmscpl;
use App\Models\Lmskdm;
use App\Models\Location;
use App\Models\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LmskdmController extends Controller
{
    public function getlmskdms($location )
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip . "?request=getLmsKdm";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);
        Lmskdm::where('location_id',$location->id)->delete() ;
        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $kdm)
                    {

                        $lmscpl = Lmscpl::where('uuid','=',$kdm['CompositionPlaylistId'])->where('location_id','=',$location->id)->first() ;
                        $screen = Screen::where('id_server','=',$kdm ['id_server_by_serial'])->where('location_id','=',$location->id)->first() ;
                        if(!$screen)
                        {
                           $id_screen = null ;
                        }
                        else
                        {
                            $id_screen = $screen->id ;
                        }
                        if($lmscpl)
                        {
                            Lmskdm::updateOrCreate([

                                'uuid' => $kdm ['uuid'],
                                'name' => $kdm ['ContentTitleText'],
                                'idkdm_files' => $kdm ['idkdm_files'],
                                'AnnotationText' => $kdm ['AnnotationText'],
                                'ContentKeysNotValidBefore' => $kdm ['ContentKeysNotValidBefore'],
                                'ContentKeysNotValidAfter' => $kdm ['ContentKeysNotValidAfter'],
                                'SubjectName' => $kdm ['SubjectName'],
                                'DeviceListDescription' => $kdm ['DeviceListDescription'],
                                'path_file' => $kdm ['path_file'],
                                'server_name' => $kdm ['server_name'],
                                'file_type' => $kdm ['file_type'],
                                'id_server' => $kdm ['id_server'],
                                'file_size' => $kdm ['file_size'],
                                'file_progress' => $kdm ['file_progress'],
                                'tms_path' => $kdm ['tms_path'],
                                'last_update' => $kdm ['last_update'],
                                'device_target' => $kdm ['device_target'],
                                'serverName_by_serial' => $kdm ['serverName_by_serial'],
                                'kdm_installed' => $kdm ['kdm_installed'],
                                'content_present' => $kdm ['content_present'],

                                'screen_id' => $id_screen,
                                'lmscpl_id' => $lmscpl->id,
                                'location_id' => $location->id,

                            ]);
                        }
                        else
                        {
                            Lmskdm::updateOrCreate([
                                'uuid' => $kdm ['uuid'],
                                'name' => $kdm ['ContentTitleText'],
                                'idkdm_files' => $kdm ['idkdm_files'],
                                'AnnotationText' => $kdm ['AnnotationText'],
                                'ContentKeysNotValidBefore' => $kdm ['ContentKeysNotValidBefore'],
                                'ContentKeysNotValidAfter' => $kdm ['ContentKeysNotValidAfter'],
                                'SubjectName' => $kdm ['SubjectName'],
                                'DeviceListDescription' => $kdm ['DeviceListDescription'],
                                'path_file' => $kdm ['path_file'],
                                'server_name' => $kdm ['server_name'],
                                'file_type' => $kdm ['file_type'],
                                'id_server' => $kdm ['id_server'],
                                'file_size' => $kdm ['file_size'],
                                'file_progress' => $kdm ['file_progress'],
                                'tms_path' => $kdm ['tms_path'],
                                'last_update' => $kdm ['last_update'],
                                'device_target' => $kdm ['device_target'],
                                'serverName_by_serial' => $kdm ['serverName_by_serial'],
                                'kdm_installed' => $kdm ['kdm_installed'],
                                'content_present' => $kdm ['content_present'],
                                //'lmscpl_id' => $cpl->id,
                                'screen_id' => $id_screen,
                                'location_id' => $location->id,

                            ]);
                        }
                    }

                    /*if(count($content) != $location->lmskdms->count() )
                    {

                        $uuid_lmskdms = array_column($content, 'uuid');

                            foreach($location->lmskdms as $lmskdm)
                            {
                                if (! in_array( $lmskdm->uuid , $uuid_lmskdms))
                                {
                                    // delete deleted screen
                                    $lmskdm->delete() ;
                                }
                            }

                        //dd('we should delete screens ') ;
                    }*/

                }
            }
        }
        return Redirect::back()->with('message' ,' The Screens  has been updated');
    }
}
