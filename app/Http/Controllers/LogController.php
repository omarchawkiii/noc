<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Log;
use App\Models\Logstitle;
use App\Models\Screen;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use TCPDF;

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
        $cpls = Logstitle::where('propertyValue','like', "%$request->searchText%") ;
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

        public function generate_pdf_report(Request $request)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf_file_name ="Repport_";

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('EXPERSYS TMS');
        $pdf->SetTitle('Exported Data');
        $pdf->SetSubject('Exported Data');
        $pdf->SetKeywords('TCPDF, PDF, export, data');

        $pdfWidth = 210; // in mm
        $pdfHeight = 297; // in mm
        $pageLayout = array(297, 210); // A4 dimensions in millimeters (width, height)
        $pdf->AddPage('L', $pageLayout);

        if( isset($request->id_location) && $request->id_location != 'null' )
        {
            $locations= explode(',', $request->id_location);
            $location_name = ' ' ;
            foreach($locations as $locatin_id)
            {
                $location = Location::find($locatin_id) ;
                $location_name .= $location->name ." " ;
            }

            $pdf->Cell(0, 10, 'Locations : '.$location_name , 0, 1);
        }
        else
        {
            $pdf->Cell(0, 10, 'Locations : ALL' , 0, 1);
        }


        if( $request->id_screen != 'null' )
        {
            $screen = Screen::find($request->id_screen) ;
            $pdf->Cell(0, 10, 'Screen :   ' . $screen->screen_name, 0, 1);
        }
        else
        {
            $pdf->Cell(0, 10, 'Screen : ALL  ' , 0, 1);
        }

        $pdf->Cell(0, 10, 'Date Generation Report: ' .  date("Y-m-d H:i:s"), 0, 1);
        //$pdf->Cell(0, 10, 'Title: ' . $_GET["title_content"], 0, 1);
        //$pdf->Cell(0, 10, 'ID: ' . $_GET["id_content"], 0, 1);
        if( isset($request->fromDate) && $request->fromDate != 'null' )
        {
            $pdf->Cell(0, 10, 'Date From: ' . $request->fromDate, 0, 1);
            $pdf_file_name .= $request->fromDate."_" ;
        }
        if(isset($request->toDate) && $request->toDate != 'null' )
        {
            $pdf->Cell(0, 10, 'Date To: ' . $request->toDate, 0, 1);
            $pdf_file_name .= $request->toDate."" ;
        }



        $pdf->Output($pdf_file_name.".pdf", 'D');

       // $locations= explode(',', $request->id_location);
       /*
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
*/
    }

}
