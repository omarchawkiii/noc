<?php

namespace App\Http\Controllers;

use App\Models\Error_list;
use App\Models\Location;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Error_listController extends Controller
{
    public function get_error_list($location,$screen )
    {

        $location = Location::find($location) ;
        $url = $location->connection_ip . "?request=get_errors_list";

        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    Error_list::updateOrCreate([
                        'location_id' => $location->id
                    ],[

                        'kdm_errors' => $content['kdm_errors'],
                        'nbr_sound_alert' => $content['nbr_sound_alert'],
                        'nbr_projector_alert' => $content['nbr_projector_alert'],
                        'nbr_server_alert' => $content['nbr_server_alert'],
                        'nbr_storage_errors' => $content['nbr_storage_errors'],
                        'location_id' => $location->id,

                    ]);
                }
            }
        }
        return Redirect::back()->with('message' ,' The Errors list  has been updated');
    }
}
