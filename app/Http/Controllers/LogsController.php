<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    //

    public function get_logs($location )
    {

        $location = Location::find($location) ;
        $screen = $location->screen ;
        $url = $location->connection_ip;
        $url ="http://localhost/tms/" ;

        $client = new Client();

        $response = $client->request('POST', $url,[
            'form_params' => [
                'action' => 'getPerformanceLogs',
                'username'=>$location->email,
                'password'=>$location->password,
                'lowID' =>0 ,
                'highID' =>1000 ,
            ]
        ]);


        $contents = json_decode($response->getBody(), true);
        dd($contents) ;
    }
}
