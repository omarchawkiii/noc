<?php

namespace App\Http\Controllers;

use App\Models\Assetinfo;
use App\Models\Location;
use App\Models\Screen;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use TCPDF;

class AssetinfoController extends Controller
{
    public function get_asset_infos($location )
    {

        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=get_asset_info";
        //dd($url);
        try {
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);
        // dd($contents);
            if($contents)
            {
                foreach($contents as $asset_info)
                {
                    if($asset_info ['screen_status'] == 1 )
                    {
                        $screen = Screen::where('screen_number','=',$asset_info ['screen_number'])->where('location_id','=',$location->id)->first() ;
                        Assetinfo::updateOrCreate([
                            'screen_number' => $asset_info["screen_number"] ,
                            'location_id' => $location->id
                        ],[

                            'screen_status' => $asset_info['screen_status'],
                            'screen_number' => $asset_info['screen_number'],
                            'screen_name' => $asset_info['screen_name'],
                            'server_product_name' => $asset_info['server_product_name'],
                            'server_esn' => $asset_info['server_esn'],
                            'server_software' => $asset_info['server_software'],
                            'projector_model_number' => $asset_info['projector_model_number'],
                            'projector_serial_number' => $asset_info['projector_serial_number'],
                            'sound_model' => $asset_info['sound_model'],
                            'sound_chasis_serial' => $asset_info['sound_chasis_serial'],
                            'sound_esn' => $asset_info['sound_esn'],
                            'projector_version'=> $asset_info['projector_version'],
                            'sound_software_version'=> $asset_info['sound_software_version'],
                            'server_firmware_version' =>  $asset_info['server_firmware_version'],

                            'screen_id'     =>$screen->id,
                            'location_id'     =>$location->id,
                        ]);
                    }

                }
            }
            return Redirect::back()->with('message' ,' The Assent infos  has been updated');
        }
        catch (RequestException $e) {
            // Log de l'erreur ou traitement spécifique

            echo " message: " . $e->getMessage();
        }
        catch (\Exception $e) {
            // Capture d'autres exceptions générales
            echo " message: " . $e->getMessage();
            return Redirect::back()->with('error', 'Unexpected error for location: ' . $location->id);
        }
    }


    public function display_performane_log()
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }
        return view('logs.asset_info', compact('locations'));
    }



    public function get_asset_infos_with_filter(Request $request)
    {

        if( $request->location != null )
        {
            $locations=$request->location;
            $asset_infos = Assetinfo::with('location') ;
            if(count($locations) == 1  )
            {
                $asset_infos = $asset_infos->whereIn('location_id',$locations);
                $location = Location::find($locations[0]) ;
                $screens =$location->screens ;
            }
            else
            {
                $screens = null ;
            }

            if( isset($request->screen) &&  $request->screen != 'null')
            {

                $screen = Screen::find($request->screen) ;
                $asset_infos = $asset_infos->where('screen_number', $screen->screen_number) ;
            }

            $asset_infos = $asset_infos->orderBy('screen_number', 'ASC')->get() ;
        }
        else
        {
            $asset_infos = null ;
            $screens = null ;
        }
        return Response()->json(compact('screens' , 'asset_infos'));
    }


    public function generate_pdf_asset_info(Request $request)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf_file_name ="asset_reports";
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('EXPERSYS NOC');
        $pdf->SetTitle('Asset Reports Data');
        $pdf->SetSubject('Asset Reports Data');
        $pdf->SetKeywords('TCPDF, PDF, export, data');

        $pdfWidth = 400; // in mm
        $pdfHeight = 297; // in mm
        $pageLayout = array(297, 600); // A4 dimensions in millimeters (width, height)
        $pdf->AddPage('L', $pageLayout);
        $pdf->Cell(0, 10, 'Asset Reports Data ' , 0,1 );
        $pdf->Cell(0, 10, 'Date Generation : ' .  date("Y-m-d H:i:s"), 0, 1);

        if( $request->location != null )
        {
            //$locations=$request->location;

            $locations= explode(',', $request->location);
            foreach($locations as $location)
            {
                $asset_infos = Assetinfo::with('location')->where('location_id' ,$location );
                $location_info = Location::find($location) ;
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(0, 10, 'Locations : '.$location_info->name , 0, 1);

             //   $pdf->Cell(40, 10, 'Location',1,0,'c');
                $pdf->Cell(25, 10, 'Screen No ',1,0,'c');
                $pdf->Cell(30, 10, 'Screen name ',1,0,'c');
                $pdf->Cell(50, 10, 'Server Product Name ',1,0,'c');
                $pdf->Cell(35, 10, 'server E-S/N',1,0,'c');
                $pdf->Cell(35, 10, 'Server Software',1,0,'c');
                $pdf->Cell(50, 10, 'Server Firmware Version',1,0,'c');
                $pdf->Cell(55, 10, 'Projector Model Number',1,0,'c');
                $pdf->Cell(55, 10, 'Projector Serial Number',1,0,'c');
                $pdf->Cell(50, 10, 'Projector Version',1,0,'c');
                $pdf->Cell(50, 10, 'Sound Model',1,0,'c');
                $pdf->Cell(50, 10, 'Sound Chasis Serial',1,0,'c');
                $pdf->Cell(40, 10, 'Sound E-S/N',1,0,'c');

                $pdf->Cell(50, 10, 'Sound Software Version',1,0,'c');


                if( isset($request->screen) &&  $request->screen != 'null')
                {
                    $screen = Screen::find($request->screen) ;
                    $asset_infos = $asset_infos->where('screen_number', $screen->screen_number);
                }

                $asset_infos = $asset_infos->orderBy('screen_number', 'ASC')->get() ;

                foreach($asset_infos as $asset_info)
                {
                    $pdf->Ln();
                    $pdf->Cell(25, 10, $asset_info->screen_number,1,0,'c');
                    $pdf->Cell(30, 10, $asset_info->screen_name,1,0,'c');
                    $pdf->Cell(50, 10, $asset_info->server_product_name,1,0,'c');
                    $pdf->Cell(35, 10, $asset_info->server_esn,1,0,'c');
                    $pdf->Cell(35, 10, $asset_info->server_software,1,0,'c');
                    $pdf->Cell(50, 10, $asset_info->server_firmware_version,1,0,'c');
                    $pdf->Cell(55, 10, $asset_info->projector_model_number,1,0,'c');
                    $pdf->Cell(55, 10, $asset_info->projector_serial_number,1,0,'c');
                    $pdf->Cell(50, 10, $asset_info->projector_version,1,0,'c');
                    $pdf->Cell(50, 10, $asset_info->sound_model,1,0,'c');
                    $pdf->Cell(50, 10, $asset_info->sound_chasis_serial,1,0,'c');
                    $pdf->Cell(40, 10, $asset_info->sound_esn,1,0,'c');

                    $pdf->Cell(50, 10, $asset_info->sound_software_version,1,0,'c');

                    //$pdf->Ln(); // Move to the next row
                }
            }
        }
        $pdf_file_name ="asset_reports". date("Y-m-d");
        $pdf->Output($pdf_file_name.'.pdf', 'D');

    }

}

