<?php

namespace App\Http\Controllers;

use App\Models\Lmscpl;
use App\Models\Location;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LmscplController extends Controller
{
    public function getlmscpls($location)
    {

        $location = Location::find($location) ;

        $url = $location->connection_ip."?request=getLmsCplList"    ;

        $client = new Client();
        $response = $client->request('GET', $url);

        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $cpl)
                    {

                        Lmscpl::updateOrCreate([
                            'uuid' => $cpl["uuid"],
                            'location_id'     =>$location->id,
                        ],[

                            'uuid' => $cpl['uuid'] ,
                            // 'id_dcp' => $cpl['id_dcp'] ,
                            'contentTitleText' => $cpl['contentTitleText'] ,
                            'contentKind' => $cpl['contentKind'] ,
                            //'EditRate' => $cpl['EditRate'] ,
                            //'is_3D'=> $cpl['is_3D'] ,
                            //'totalSize' => $cpl['totalSize'] ,
                            //'soundChannelCount'=> $cpl['soundChannelCount'] ,
                            'durationEdits' => $cpl['durationEdits'] ,
                            'ScreenAspectRatio'=> $cpl['ScreenAspectRatio'] ,
                            'available_on'=> $cpl['available_on'] ,
                            //'serverName'=> $cpl['serverName'] ,
                            //'cpl_is_linked'=> $cpl['cpl_is_linked'] ,
                            'date_create_ingest'=> $cpl['date_create_ingest'] ,
                            'pictureEncryptionAlgorithm'=> $cpl['pictureEncryptionAlgorithm'] ,
                            'Width'=> $cpl['pictureWidth'] ,
                            'Height' => $cpl['pictureHeight'] ,
                            'location_id'=> $location->id,

                        ]);
                    }

                    if(count($content) != $location->lmscpls->count() )
                    {
                        $uuid_lmscpl = array_column($content, 'uuid');
                            foreach($location->lmscpls as $lmscpl)
                            {
                                if (! in_array( $lmscpl->uuid , $uuid_lmscpl))
                                {
                                    $lmscpl->delete() ;
                                }
                            }
                    }
                }
            }
        }
        return Redirect::back()->with('message' ,' The LMS cpls  has been updated');
    }

    public function get_lmscpl_infos($cpl )
    {
        $cpl = Lmscpl::find($cpl) ;
        $spls = $cpl->lmsspls ;
        $kdms =null ;

        $schedules = null ;
        return Response()->json(compact('cpl','spls','kdms'));
    }


}
