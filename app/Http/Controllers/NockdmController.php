<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Kdm;
use App\Models\Lmskdm;
use App\Models\Nockdm;
use App\Models\Screen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NockdmController extends Controller
{
    public function uploadlocalkdm(Request $request)
    {
            $data_location = array() ;
            $ingest_success = array() ;
            $ingest_errors = array();
            $ingest_status= array();
        try
        {

            foreach ($request->kdmfiles as $kdmfile )
            {


                if ($kdmfile->extension() === 'xml')
                {
                    $kdm_file_content = simplexml_load_file($kdmfile);
                    if($kdm_file_content)
                    {
                        $file_content = $kdm_file_content->asXML();
                        if($file_content)
                        {
                            if($kdm_file_content->getName() == 'DCinemaSecurityMessage')
                            {

                                $kdm_file_data ["MessageId"] = (string)$kdm_file_content->AuthenticatedPublic->MessageId;
                                $kdm_file_data ["AnnotationText"] = (string)$kdm_file_content->AuthenticatedPublic->AnnotationText;
                                $kdm_file_data ["CompositionPlaylistId"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->CompositionPlaylistId;

                                if((string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions)
                                {
                                    $kdm_file_data ["SubjectName"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->Recipient->X509SubjectName;
                                    $kdm_file_data ["DeviceListDescription"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->AuthorizedDeviceInfo->DeviceListDescription;
                                    $SubjectName=(string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->Recipient->X509SubjectName;
                                    $kdm_file_data ["ContentTitleText"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->ContentTitleText;
                                    $kdm_file_data ["ContentKeysNotValidBefore"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->ContentKeysNotValidBefore;
                                    $kdm_file_data ["ContentKeysNotValidAfter"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->ContentKeysNotValidAfter;
                                }
                                else
                                {
                                    $kdm_file_data ["SubjectName"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->Recipient->X509SubjectName;
                                    $kdm_file_data ["DeviceListDescription"] = "null";
                                    $SubjectName=(string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->Recipient->X509SubjectName;
                                    $kdm_file_data ["ContentTitleText"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->ContentTitleText;
                                    $kdm_file_data ["ContentKeysNotValidBefore"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->ContentKeysNotValidBefore;
                                    $kdm_file_data ["ContentKeysNotValidAfter"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->ContentKeysNotValidAfter;
                                }
                                $kdm_file_data ["SerialNumber"] = (string)$kdm_file_content->Signer->X509SerialNumber;



                                $pattern = '/\b\d{6}\b/';
                                if (preg_match($pattern, $SubjectName, $matches)) {
                                    // Extract the matched 6-digit number
                                    $serial_number = $matches[0];
                                } else {
                                    $serial_number="unknown";
                                }

                                $file_name = $kdm_file_data['MessageId'].".xml" ;
                                $cn_dn_table = $this->getDnCn($kdm_file_data ["SubjectName"]);
                                $screen =  $this->getScreenByDnCn( $cn_dn_table['dnQualifier'],$cn_dn_table['CN'],$serial_number) ;
                                if(!$screen)
                                {
                                    $dn_cleaned = str_replace('\\', '', $cn_dn_table['dnQualifier']);
                                    $screen =  $this->getScreenByDnCn(  $dn_cleaned,$cn_dn_table['CN'],$serial_number) ;
                                }


                                $file_url = Storage::disk('local')->put( $file_name, $file_content) ;

                                if($screen)
                                {
                                    $file_url = Storage::disk('local')->put( $file_name, $file_content) ;
                                    $location = $screen->location ;
                                    $location_id = $location->id ;
                                    $screen_id = $screen->id ;
                                    $cpl = Cpl::where('uuid','=',$kdm_file_data['CompositionPlaylistId'])->where('location_id','=',$location->id)->first() ;
                                    if($cpl != null)
                                    {
                                        $cpl_id = $cpl->id ;
                                    }
                                    else
                                    {
                                        $cpl_id =null ;
                                    }
                                    $xmlFilePath =    storage_path().'/app/xml_file/'.$file_name ;

                                    $response = $this->updateKdm($location->connection_ip,$kdm_file_data ["MessageId"],$xmlFilePath,$location->email,$location->password ) ;
                                    $tms_ingested = false ;
                                    $error = "-" ;
                                    /*dd($response != null);
                                    dd($response,$location->connection_ip,$kdm_file_data ["MessageId"],$xmlFilePath,$location->email,$location->password );*/

                                    if($response != null)
                                    {
                                        if($response['status']== 1 )
                                        {
                                            $error = "-" ;
                                            $tms_ingested = true ;
                                            array_push($ingest_success,  array("status" => $response['status'] , "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  $kdm_file_data ["MessageId"] , "AnnotationText" =>  "Uploaded Successfully"));
                                        }
                                        else
                                        {

                                            $tms_ingested = false ;
                                            $error = "TMS Offline";
                                            array_push($ingest_errors,  array("status" => $response['status'], "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  $kdm_file_data ["MessageId"],  "AnnotationText" =>  "TMS Offline"));
                                        }
                                    }
                                    else
                                    {

                                        $tms_ingested = false ;
                                        $error = "TMS Offline";
                                        array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  $kdm_file_data ["MessageId"],  "AnnotationText" =>  "TMS Offline"));
                                    }

                                   /* $new_kdm = Kdm::updateOrCreate([
                                        'uuid' => $kdm_file_data['MessageId'],
                                        'location_id' =>  $location_id ,
                                    ],[
                                        'uuid' => $kdm_file_data['MessageId'],
                                        'name' => $kdm_file_data ["ContentTitleText"],
                                        'ContentKeysNotValidBefore' => $kdm_file_data ["ContentKeysNotValidBefore"],
                                        'ContentKeysNotValidAfter' => $kdm_file_data ["ContentKeysNotValidAfter"],
                                        //'kdm_installed' => $kdm['kdm_installed'],
                                        //'content_present' => $kdm['content_present'],
                                        'serverName_by_serial' => $kdm_file_data ["SerialNumber"],
                                        'cpl_uuid' => null,
                                        'cpl_id' => null,
                                        'screen_id' => $screen_id,
                                        'location_id' => $location_id,

                                    ]);*/


                                    $noc_kdm = Nockdm::updateOrCreate([
                                        'uuid' => $kdm_file_data['MessageId'],
                                        'location_id' =>  $location_id ,
                                    ],[
                                        'uuid' => $kdm_file_data['MessageId'],
                                        'name' => $kdm_file_data ["ContentTitleText"],
                                        'xmlpath'=> $file_name ,
                                        'ContentKeysNotValidBefore' => $kdm_file_data ["ContentKeysNotValidBefore"],
                                        'ContentKeysNotValidAfter' => $kdm_file_data ["ContentKeysNotValidAfter"],
                                        /* 'kdm_installed' => $kdm['kdm_installed'],
                                        'content_present' => $kdm['content_present'], */
                                        'serverName_by_serial' => $kdm_file_data ["SerialNumber"],
                                        'cpl_uuid' => $kdm_file_data['CompositionPlaylistId'],
                                        'error' => $error,
                                        'tms_ingested' => $tms_ingested,
                                        'cpl_id' => $cpl_id,
                                        'screen_id' => $screen_id,
                                        'location_id' => $location_id,
                                    ]);


                                    //dd($new_kdm,$new_kdm->location_id);

                                }
                                else
                                {
                                    $tms_ingested = false ;
                                    $screen_id = null ;
                                    $cpl_id =null ;
                                    $error = "This KDM does not belong to any screen";
                                    array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  $kdm_file_data ["MessageId"],  "AnnotationText" =>  $error));
                                }


                                /*$noc_kdm = Nockdm::updateOrCreate([
                                    'uuid' => $kdm_file_data['MessageId'],
                                    'location_id' =>  $location_id ,
                                ],[
                                    'uuid' => $kdm_file_data['MessageId'],
                                    'name' => $kdm_file_data ["ContentTitleText"],
                                    'xmlpath'=> $file_name ,
                                    'ContentKeysNotValidBefore' => $kdm_file_data ["ContentKeysNotValidBefore"],
                                    'ContentKeysNotValidAfter' => $kdm_file_data ["ContentKeysNotValidAfter"],

                                    'serverName_by_serial' => $kdm_file_data ["SerialNumber"],
                                    'cpl_uuid' => $kdm_file_data['CompositionPlaylistId'],
                                    'error' => $error,
                                    'tms_ingested' => $tms_ingested,
                                    'cpl_id' => $cpl_id,
                                    'screen_id' => $screen_id,
                                    'location_id' => $location_id,
                                ]);*/




                                /*else
                                {
                                    $cpl_id =null ;
                                    $screen_id = null ;
                                    $location_id = null ;
                                    $error = "This KDM does not belong to any screen" ;
                                    $tms_ingested = false ;
                                    array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName(), "id" =>  "",  "AnnotationText" =>  "This KDM does not belong to any screen"));
                                }*/



                            }
                            else
                            {
                                array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName(), "id" =>  "",  "AnnotationText" =>  "This is not a KDM file"));
                            }

                        }
                        else
                        {
                            array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  "",  "AnnotationText" =>  "This is not a KDM file"));
                        }
                    }
                    else
                    {
                        array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  "",  "AnnotationText" =>  "This is not a KDM file"));
                    }
                }
                else
                {
                    array_push($ingest_errors,  array("status" => 0 , "originalName" =>  $kdmfile->getClientOriginalName() , "id" =>  "",  "AnnotationText" =>  "This is not a KDM file"));
                }
            }

            $ingest_status = array("status" => 1,  "message " => "") ;
            return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
            /*if(count($ingest_errors) > 0  )
            {
                return Response()->json(compact('ingest_errors','ingest_success'));
            }
            else
            {
                return Response()->json(compact('ingest_errors','ingest_success'));
            }*/

        } catch (Exception $e) {

            $ingest_status = array("status" => 0 , "message " => $e->getMessage()) ;
            return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
            echo "Failed" ;
            //return $e;
        }
    }

    public function getDnCn($SubjectName)
    {
        $keys = ['dnQualifier', 'CN', 'O', 'OU'];
        $result = [];

        // Iterate through the keys and extract the corresponding values
        foreach ($keys as $key)
        {
            preg_match('/' . $key . '=([^,]+)/', $SubjectName, $matches);
            if (isset($matches[1]))
            {
                $result[$key] = $matches[1];
            }
        }
        return $result;
    }
    public function getScreenByDnCn($dn,$cn,$serial_number)
    {

        $screen = Screen::where('dolby_audio_processor_dnQualifier',$dn)
        ->orWhere(function ($q) use ($dn , $cn) {

            $q->where('jp2k_dnQualifier', $dn)->Where('jp2k_cn', $cn);
        })
        ->orWhere('serial_number',$serial_number)
       ->first() ;

       return $screen ;
    }

    public function get_nockdm(Request $request)
    {

        $location = $request->location;
        $screen = $request->screen;

        $nockdms = Nockdm::with('screen')->with('location');
        $screens = null ;
        if(isset($location) &&  $location != 'null' )
        {
            $screens = Screen::where('location_id', $location)->get() ;
            $nockdms =$nockdms->where('location_id',$location);
        }


        if(isset($screen) &&  $screen != 'null' )
        {
             $nockdms =$nockdms->where('screen_id',$screen);
        }
        $nockdms =$nockdms->get() ;
        return Response()->json(compact('nockdms','screens'));
    }

    function updateKdm($apiUrl,$uuid,$xmlFilePath,$username,$password )
    {
        if (!file_exists($xmlFilePath)) {
            return ['error' => 'File not found.'];
        }
        // Read XML content from the file
        $xmlData = file_get_contents($xmlFilePath);

        // Prepare the request data
        $requestData = [
            'action' => 'updateKdm',
            'xmlData' => $xmlData,
            'uuid'=>$uuid,
            'username'=>$username,
            'password'=>$password
        ];

        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
      //  dd($response);
       // return $response;
        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Curl error: ' . curl_error($ch) , 'status' => 0];
        }

        // Close cURL session
        curl_close($ch);

        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.', 'status' => 0];
        } else {
            return json_decode($response,true);
        }
    }

    public function uploadexistingkdm(Request $request)
    {

        $ingest_status= array();
        $ingest_errors = array() ;
        $ingest_success = array() ;

        try
        {
            $noc_kdm = Nockdm::where('id',$request->kdm_id)->first() ;
            $location = $noc_kdm->location ;
            if($location)
            {
                $xmlFilePath =    storage_path().'/app/xml_file/'.$noc_kdm->xmlpath ;
                $response = $this->updateKdm($location->connection_ip,$noc_kdm->uuid,$xmlFilePath,$location->email,$location->password ) ;
              //  $response = json_decode($response) ;
                if($response != null)
                {
                    if($response['status']== 1 )
                    {

                        $noc_kdm->update([
                            'tms_ingested'=> 1  ,
                                'error'=> "-"
                        ]);

                        array_push($ingest_success,  array("status" => 1 , "id" =>  $noc_kdm->uuid , "AnnotationText" =>  $noc_kdm->name));
                    }
                    else
                    {
                        array_push($ingest_errors,  array("status" =>0 , "id" =>  $noc_kdm->uuid , "AnnotationText" =>  $noc_kdm->name ));
                    }
                }
                else
                {
                    array_push($ingest_errors,  array("status" => 0, "id" =>  $noc_kdm->uuid , "AnnotationText" =>  $noc_kdm->name ));
                }
            }
            else
            {
                array_push($ingest_errors,  array("status" => 0 , "id" =>  $noc_kdm->uuid , "AnnotationText" =>  $noc_kdm->name ));
            }


            $ingest_status = array("status" => 1,  "message " => "") ;
            return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));

           /*
            if(count($ingest_errors) > 0  )
            {
                return Response()->json(compact('ingest_errors','ingest_success'));
            }
            else
            {
                return Response()->json(compact('ingest_errors','ingest_success'));
            }
            */

        } catch (Exception $e) {
            $ingest_status = array("status" => 0 , "message " => $e->getMessage()) ;
            return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
        }

    }

    public function destroy($id)
    {
        $nockdm= Nockdm::find($id) ;
        $path = storage_path(). '/app/xml_file/'.$nockdm->xmlpath ;
        if($nockdm->delete())
        {
            $res =unlink($path);
            if($res)
            {
                echo 'Success' ;
            }
            else
            {
                echo 'Failed' ;
            }
        }
        else
        {
            echo 'Failed' ;
        }
    }

    public function delete_all()
    {
        $nockdms= Nockdm::all() ;
        foreach($nockdms as $nockdm)
        {
            $path = storage_path(). '/app/xml_file/'.$nockdm->xmlpath ;
            if($nockdm->delete())
            {
               unlink($path);
            }
        }
        echo 'Success' ;
    }


}
