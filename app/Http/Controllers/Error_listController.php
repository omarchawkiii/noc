<?php

namespace App\Http\Controllers;

use App\Models\Error_list;
use App\Models\Location;
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
        }
        return Redirect::back()->with('message' ,' The Errors list  has been updated');
    }
}
