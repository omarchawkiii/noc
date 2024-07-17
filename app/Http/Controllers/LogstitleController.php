<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Logstitle;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Locale;

class LogstitleController extends Controller
{
    public function get_logstitle($location )
    {
        $location = Location::find($location) ;

        $url = $location->connection_ip;
        //$url ="http://localhost/tms/system/api2.php" ;

                $client = new Client();
                $response = $client->request('POST', $url,[
                    'form_params' => [
                        'action' => 'getLogsCplSPLTitles',
                        'username'=>$location->email,
                        'password'=>$location->password,
                    ]
                ]);

                $contents = json_decode($response->getBody(), true);
                if(count($contents['result']) > 0 )
                {
                    foreach($contents['result'] as $log)
                    {
                        Logstitle::updateOrCreate([
                            'recKeywords' => $log['recKeywords'] ,
                            'location_id' => $location->id,
                        ],[
                            'recKeywords' => $log['recKeywords'],
                            'propertyValue' => $log['propertyValue'],
                            'type' => $log['type'],
                            'location_id' => $location->id,
                        ]);
                    }
                }



    }

    public function asset_reports()
    {
        return view('soon');
    }

    public function lamp_reports()
    {
        $locations = Location::all();
        return view('logs.lamp_reports',compact('locations'));
    }

    public function storage_reports()
    {
        $locations = Location::all();
        return view('logs.storage_reports',compact('locations'));
    }

}
