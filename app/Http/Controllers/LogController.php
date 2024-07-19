<?php


namespace App\Http\Controllers;

ini_set('max_execution_time', 1800);

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Log;
use App\Models\Logstitle;
use App\Models\Screen;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCPDF;

class LogController extends Controller
{
    public function get_logs($location )
    {

        $location = Location::find($location) ;
        $screens = $location->screens ;
        $url = $location->connection_ip;
        //$url ="http://localhost/tms/system/api2.php" ;
        foreach($screens as $screen)
        {
            $last_log= Log::latest('created_at')->where('screen_id',1)->first() ;

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
                        //'screen_number'=>$screen->screen_number,
                        'screen_number'=>1,
                        'lowID' =>$lowID,
                        'highID' =>$highID,
                    ]
                ]);
                $lowID =$highID ;
                 $highID = $lowID + 10000 ;
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
                            'screen_id' =>1,//$screen->id ,
                        ]);
                    }
                }
                else
                {

                }
            }

            dd('end  screen 1' ) ;
        }

    }

    public function get_performance_log()
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }
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

    public function get_logs_with_filter($id_location,$id_screen,$fromDate,$toDate,$id_content)
    {
        $logs = Log::with('location') ;
        if( $id_content != 'null' )
        {
            $logs = $logs->where('recKeywords',$id_content) ;
        }

        if( $id_location != 'null' )
        {
            //$locations= explode(',', $id_location);
            $logs = $logs->whereIn('location_id',$id_location) ;
        }
        if( $id_screen != 'null' )
        {
            $logs = $logs->where('screen_number', $id_screen) ;
        }

        if( isset($fromDate) && $fromDate != 'null' )
        {
            $fromDate = Carbon::parse($fromDate);

            $logs = $logs->where('converted_rec_date','>',  $fromDate ) ;
        }

        if(isset($toDate) && $toDate != 'null' )
        {
            $toDate = Carbon::parse($toDate);
            $logs = $logs->where('converted_rec_date','<',  $toDate ) ;
        }
        $logs = $logs ;
        return $logs ;
    }
    public function getListlogs(Request $request)
    {
        $logs = $this->get_logs_with_filter($request->id_location,$request->id_screen,$request->fromDate,$request->toDate,$request->id_content)->get();
        return Response()->json(compact('logs'));
    }

    public function generate_pdf_report(Request $request)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf_file_name ="";
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
        $pdf->Cell(0, 10, 'Title: ' .$request->title_content, 0, 1);
        $pdf->Cell(0, 10, 'ID: ' .$request->id_content , 0, 1);
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
        $pdf_file_name .= $request->title_content."" ;


        $failed =  Log::where('recKeywords',$request->id_content)->where('recSubtype','=','PlayoutAlert')->get()->count() ;
        $played =  Log::where('recKeywords',$request->id_content)->where('recSubtype','=','CPLStart')->get()->count() ;

        $pdf->Cell(0, 10, 'Played ( CPLStart ) : ' . $played, 0, 1);
        $pdf->Cell(0, 10, 'Failed ( Playouts Alert ): ' . $failed, 0, 1);

        if(isset($request->id_screen) && $request->id_screen == 'null' )
        {
            $locations= explode(',', $request->id_location);
            $location_name = ' ' ;
            foreach($locations as $locatin_id)
            {
                $location = Location::find($locatin_id) ;

                $pdf->Ln();
                $pdf->Cell(0, 10, 'Locations : '.$location->name , 0, 1);

                $pdf->SetFont('helvetica', '', 10);
                $pdf->Cell(40, 10, 'Screen ', 1, 0, 'C');
                $pdf->Cell(40, 10, 'Played', 1, 0, 'C');
                $pdf->Cell(40, 10, 'Failed', 1, 0, 'C');
                $pdf->Ln();


                foreach($location->screens  as $screen)
                {
                    $failed= Log::where('location_id',$location->id)->where('screen_id',$screen->id)->where('recKeywords',$request->id_content)->where('recSubtype','PlayoutAlert')->get()->count() ;
                    $played  = Log::where('location_id',$location->id)->where('screen_id',$screen->id)->where('recKeywords',$request->id_content)->where('recSubtype','CPLStart')->get()->count() ;
                    $pdf->Cell(40, 10,  $screen->screen_name , 1, 0, 'C');
                    $pdf->Cell(40, 10, $played, 1, 0, 'C');
                    $pdf->Cell(40, 10,  $failed, 1, 0, 'C');
                    $pdf->Ln(); // Move to the next row
                }



            }

        }else{
            $locations= explode(',', $request->id_location);
            $location_name = ' ' ;
            foreach($locations as $locatin_id)
            {
                $location = Location::find($locatin_id) ;

                    $failed = Log::where('location_id',$location->id)->where('screen_id',$request->id_screen)->where('recKeywords',$request->id_content)->where('recSubtype','PlayoutAlert')->get()->count() ;
                    $played = Log::where('location_id',$location->id)->where('screen_id',$request->id_screen)->where('recKeywords',$request->id_content)->where('recSubtype','CPLStart')->get()->count() ;
                    $pdf->Cell(40, 10,  $screen->screen_name , 1, 0, 'C');
                    $pdf->Cell(40, 10, $played, 1, 0, 'C');
                    $pdf->Cell(40, 10,  $failed, 1, 0, 'C');
                    $pdf->Ln(); // Move to the next row
            }
        }

        $locations= explode(',', $request->id_location);
        $logs = $this->get_logs_with_filter($locations ,$request->id_screen,$request->fromDate,$request->toDate,$request->id_content);

        $pdf->Ln();

        $pdf->Cell(0, 10, 'Log Data : '  , 0, 1);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(40, 10, 'recId', 1, 0, 'C');
        $pdf->Cell(40, 10, 'recType', 1, 0, 'C');
        $pdf->Cell(40, 10, 'recSubtype', 1, 0, 'C');
        $pdf->Cell(40, 10, 'recPriority', 1, 0, 'C');
        //    $pdf->Cell(40, 10, 'recKeywords', 1, 0, 'C');
        $pdf->Cell(40, 10, 'date', 1, 0, 'C');
        $pdf->Cell(40, 10, 'screen', 1, 0, 'C');
        $pdf->Ln();

        $i = 1 ;

        $logs = $logs->where('recSubtype','!=','ScheduleStart')
                    ->where('recSubtype','!=','MacroComplete')
                    ->where('recSubtype','!=','CPLCheck')
                    ->where('recSubtype','!=','SPLStart')
                    ->orderBy('screen_id', 'Asc')
                    ->orderBy('recId', 'Asc')
                    ->orderBy('converted_rec_date', 'Asc')
                    ->orderBy('recKeywords', 'Asc')
                    ->orderBy('screen_id', 'Asc')
                    ->get();


        foreach($logs as $log)
        {
            if ($log->recSubtype == 'CPLStart') {
                $pdf->Cell(240, 10, $i, 1, 0, 'C');

                $i++;
                $pdf->Ln();
            }
            $pdf->Cell(40, 10, $log->recId, 1, 0, 'C');
            $pdf->Cell(40, 10, $log->recType, 1, 0, 'C');
            $pdf->Cell(40, 10, $log->recSubtype, 1, 0, 'C');
            $pdf->Cell(40, 10, $log->recPriority, 1, 0, 'C');
            $pdf->Cell(40, 10, $log->converted_rec_date, 1, 0, 'C');
            $pdf->Cell(40, 10, $log->serverName, 1, 0, 'C');
            $pdf->Ln(); // Move to the next row


            if ($log->recSubtype== 'CPLEnd')
            {
                $pdf->SetDrawColor(0, 0, 0); // Set line color to black
                $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 120, $pdf->GetY()); // Draw line
                $pdf->Ln();
            }
        }
        $pdf->Output($pdf_file_name.'.pdf', 'D');

    }

}
