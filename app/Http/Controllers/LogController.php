<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Log;
use App\Models\Screen;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LogController extends Controller
{
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

    public function get_performance_log()
    {
        $locations = Location::all() ;
        return view('logs.performance_logs', compact('locations'));
    }

    public function get_screen_from_location(Request $request)
    {
        if( $request->location != null )
        {
            $locations= explode(',', $request->location);
            if(count($locations) == 1  )
            {
                $location = Location::find($request->location) ;
                $screens =$location->screens ;
            }
            else
            {
                $screens = null ;
            }
        }
        else
        {
            $screens = null ;
        }
        return Response()->json(compact('screens'));
    }

    public function get_suggestion_cpls(Request $request)
    {
        //$location = Location::find($request->location) ;
        $cpls = Cpl::where('contentTitleText','like', "%$request->searchText%")->groupBy('uuid') ;
        if( $request->location != null )
        {
            $locations= explode(',', $request->location);
            $cpls = $cpls->whereIn('location_id',$locations) ;
        }
        $cpls = $cpls->get();
        return Response()->json(compact('cpls'));
    }


    public function getListlogs(Request $request)
    {

       // $locations= explode(',', $request->id_location);
        $logs = Log::with('location') ;
        if( $request->id_location != 'null' )
        {
            $logs = $logs->whereIn('location_id',$request->id_location) ;
        }
        if( $request->id_screen != 'null' )
        {
            $logs = $logs->where('screen_id', $request->id_screen) ;
        }

        if( isset($request->fromDate) && $request->fromDate != 'null' )
        {
            $fromDate = Carbon::parse($request->fromDate);

            $logs = $logs->where('converted_rec_date','>',  $fromDate ) ;
        }

        if(isset($request->toDate) && $request->toDate != 'null' )
        {
            $toDate = Carbon::parse($request->toDate);
            $logs = $logs->where('converted_rec_date','<',  $toDate ) ;
        }
        $logs = $logs->get() ;
        return Response()->json(compact('logs'));

    }
}
