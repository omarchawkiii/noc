<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Log;
use App\Models\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //

    public function get_logs($location )
    {

        $location = Location::find($location) ;
        $screens = $location->screens ;
        $url = $location->connection_ip;
        $url ="http://localhost/tms/system/api2.php" ;
        foreach($screens as $screen)
        {
            $last_log= Log::latest('created_at')->first() ;
            if($last_log != null)
            {
                $lowID=  $last_log->recId + 1  ;
            }
            else
            {
                $lowID = 0 ;
            }
            $highID = $lowID + 10000 ;
            while ($highID <= 1000000) {
                $client = new Client();
                $response = $client->request('POST', $url,[
                    'form_params' => [
                        'action' => 'getPerformanceLogs',
                        'username'=>$location->email,
                        'password'=>$location->password,
                        'screen_number'=>$screen->screen_number,
                        'lowID' =>$lowID,
                        'highID' =>$highID,
                    ]
                ]);

                $contents = json_decode($response->getBody(), true);
                if(count($contents['result']) > 0 )
                {
                    foreach($contents['result'] as $log)
                    {
                        Log::updateOrCreate([
                            'recId' => $log['recId'] ,
                            'location_id' => $location->id,
                            'screen_id' =>$screen->id ,
                        ],[
                            'recId' => $log['recId'],
                            'converted_rec_date' => $log['converted_rec_date'],
                            'recType' => $log['recType'],
                            'recSubtype' => $log['recSubtype'],
                            'recPriority' => $log['recPriority'],
                            'recKeywords' => $log['recKeywords'],
                            'screen_number' => $log['screen_number'],
                            'Abbreviation' => $log['Abbreviation'],
                            'serverName' => $log['serverName'],
                            'location_id' => $location->id,
                            'screen_id' =>$screen->id ,
                        ]);
                    }
                }
            }
        }

    }


}
