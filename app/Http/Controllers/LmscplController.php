<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Lmscpl;
use App\Models\Location;
use App\Models\splcomponents;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class LmscplController extends Controller
{
    public function getlmscpls($location)
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=getLmsCplList"    ;
        try{
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

                                if($cpl['available_on'] ==[])
                                {
                                    $available_on = "" ;
                                }
                                else
                                {
                                    $available_on = $cpl['available_on'] ;
                                }
                            Lmscpl::updateOrCreate([
                                'uuid' => $cpl["uuid"],
                                'location_id'     =>$location->id,
                            ],[

                                'uuid' => $cpl['uuid'] ,
                                // 'id_dcp' => $cpl['id_dcp'] ,
                                'contentTitleText' => $cpl['contentTitleText'] ,
                                'contentKind' => $cpl['contentKindMajuscule'] ,
                                'EditRate' => $cpl['EditRate'] ,
                                //'is_3D'=> $cpl['is_3D'] ,
                                'totalSize' => $cpl['totalSize'] ,
                                'soundChannelCount'=> $cpl['soundChannelCount'] ,
                                'durationEdits' => $cpl['durationEdits'] ,
                                'ScreenAspectRatio'=> $cpl['ScreenAspectRatio'] ,
                                'available_on'=> $available_on ,
                                //'serverName'=> $cpl['serverName'] ,
                                'cpl_is_linked'=> $cpl['cpl_is_linked'] ,
                                'date_create_ingest'=> $cpl['date_create_ingest'] ,
                                'pictureEncryptionAlgorithm'=> $cpl['pictureEncryptionAlgorithm'] ,
                                'Width'=> $cpl['pictureWidth'] ,
                                'Height' => $cpl['pictureHeight'] ,
                                'type' => $cpl['type_ScreenAspectRatio']['type'],
                                'cinema_DCP' => $cpl['type_ScreenAspectRatio']['Cinema_DCP'],
                                'aspect_Ratio' => $cpl['type_ScreenAspectRatio']['Aspect_Ratio'],
                                'duration_seconds' => $cpl['Duration_seconds'],
                                'duration' => $cpl['Duration'],
                                'editRate_numerator'=> $cpl['editRate_numerator'] ,
                                'editRate_denominator' => $cpl['editRate_denominator'] ,
                                'kdm_required' => $cpl['kdm_required'] ,
                                'location_id'=> $location->id,




                            ]);

                            //dd($cpl);
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
        catch (RequestException $e) {
            // Log de l'erreur ou traitement spécifique
            echo " message: " . $e->getMessage();
        }

    }
    public function get_lmscpl_infos($cplid )
    {

        if (Str::startsWith($cplid, 'urn:uuid:'))
        {
            $cpl = Lmscpl::where('uuid',$cplid)->first() ;
        }
        else
        {
            $cpl = Lmscpl::find($cplid) ;
        }

        if($cpl)
        {
            $spls = DB::table('splcomponents')
                ->leftJoin('lmsspls', 'splcomponents.uuid_spl', '=', 'lmsspls.uuid')
                ->leftJoin('spls', 'splcomponents.uuid_spl', '=', 'spls.uuid')
                ->where('splcomponents.CompositionPlaylistId',$cpl->uuid)
                ->where('splcomponents.location_id',$cpl->location_id)
                ->select('splcomponents.uuid_spl as uuid_spl','lmsspls.name as lms_name','spls.name as name','lmsspls.duration as lms_duration')
                ->groupBy('splcomponents.uuid_spl')
                ->get();
        }
        else
        {

            //$cpl = Cpl::find($cplid) ;
            if (Str::startsWith($cplid, 'urn:uuid:'))
            {
                $cpl = Lmscpl::where('uuid',$cplid)->first() ;
            }
            else
            {
                $cpl = Lmscpl::find($cplid) ;
            }
            dd(Str::isUuid($cplid), $cplid ) ;
            $spls = DB::table('splcomponents')
                ->where('splcomponents.CompositionPlaylistId',$cpl->uuid)
                ->leftJoin('spls', 'splcomponents.uuid_spl', '=', 'spls.uuid')
                ->leftJoin('lmsspls', 'splcomponents.uuid_spl', '=', 'lmsspls.uuid')
                ->where('splcomponents.location_id',$cpl->location_id)

                ->select('splcomponents.uuid_spl as uuid_spl','lmsspls.name as lms_name','spls.name as name','lmsspls.duration as lms_duration')
                ->groupBy('splcomponents.uuid_spl')
                ->get();
        }
        $kdms =Kdm::with('screen')->where('cpl_uuid',$cpl->uuid)->where('location_id',$cpl->location_id)->get();

        return Response()->json(compact('cpl','spls','kdms'));
    }
}
