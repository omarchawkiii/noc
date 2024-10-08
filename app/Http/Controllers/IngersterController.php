<?php

namespace App\Http\Controllers;

use App\Models\Dcp_trensfer;
use App\Models\Ingestsource;
use App\Models\Location;
use Exception;
use getID3;
use getid3_lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class IngersterController extends Controller
{

    public function index()
    {
        return view('ingester.index');
    }

    public function action_contoller()
    {

        if (isset($_POST["action_control"])) {

            if ($_POST["action_control"] == "get_screens") {
                /*$managerServer = new ServerManager(getdb());
                $servers = $managerServer->getSourcesIngest();
                echo json_encode($servers->fetchAll(PDO::FETCH_ASSOC));*/
                $sources = Ingestsource::all() ;
               // return Response()->json(compact('kdms','screens'));
                //dd(DB::connection('mysql'));
                echo json_encode(Ingestsource::all());
            }
            if ($_POST["action_control"] == "scan_server") {

                /*$manager_server = new ServerManager(getdb());
                $ingester_manager = new IngesterManager(getdb());
                $server = $manager_server->getServerData($_POST["screen_id"]);*/
                $server = Ingestsource::find($_POST["screen_id"]) ;
               // dd($server) ;
               /*
               if ($manager_server->getScreenTypeById($_POST["screen_id"]) == "Screen")
               {
                    $soapManagement = new SoapManagement();
                    $session = $soapManagement->login($server['usernameAdmin'], $server['passwordAdmin'], $server['serverName'], $server['managment_ip'], $server['id_server'], getdb());

                    $verified_dcp_content = array();
                    $verified_spl = array();
                    if ($session == NULL) {
                        $response = array("session" => 0, "dcp_content" => 0, "spl_content" => 0);
                    } else {
                        //dcp content
                        $soapManagement->CancelScan($session, $server['managment_ip']);
                        $soapManagement->ClearScan($session, $server['managment_ip']);
                        $soapManagement->StartScan($session, $server['managment_ip'], "data/assets/");
                        $status = $soapManagement->GetScanStatus($session, $server['managment_ip']);

                        if ($status == "Completed") {
                            $content = $soapManagement->GetScanResult($session, $server['managment_ip']);

                        } else {
                            while ($status != "Completed") {
                                $status = $soapManagement->GetScanStatus($session, $server['managment_ip']);
                            }
                            $content = $soapManagement->GetScanResult($session, $server['managment_ip']);

                        }
                        if (empty(get_object_vars($content->assetList))) {

                        } else {
                            $content = $content->assetList->asset;
                            foreach ($content as $item) {
                                $download_status = $ingester_manager->checkDownloadStatus($item->id);
                                $item->downloaded_to_tms = ($download_status == "Complete" ? 1 : 0);
                                $item->current_status = $download_status;
                                array_push($verified_dcp_content, $item);
                            }
                        }


                        //  get spl content
                        $soapManagement->CancelScan($session, $server['managment_ip']);
                        $soapManagement->ClearScan($session, $server['managment_ip']);
                        $soapManagement->StartScan($session, $server['managment_ip'], "data/playlists/");
                        $status = $soapManagement->GetScanStatus($session, $server['managment_ip']);

                        if ($status == "Completed") {
                            $spl_content = $soapManagement->GetScanResult($session, $server['managment_ip']);
                        } else {
                            while ($status != "Completed") {
                                $status = $soapManagement->GetScanStatus($session, $server['managment_ip']);
                            }
                            $spl_content = $soapManagement->GetScanResult($session, $server['managment_ip']);

                        }

                        if (empty(get_object_vars($spl_content->assetList))) {

                        } else {
                            $spl_content = $spl_content->assetList->asset;
                            if (is_array($spl_content)) {
                                foreach ($spl_content as $item) {
                                    $item->downloaded_to_tms = $ingester_manager->checkSplIsDownloaded($item->id);
                                    array_push($verified_spl, $item);
                                }
                            } else {
                                $spl_content->downloaded_to_tms = $ingester_manager->checkSplIsDownloaded($spl_content->id);
                                array_push($verified_spl, $spl_content);
                            }

                        }
                        $response = array("session" => 1, "type" => "screen", "dcp_content" => $verified_dcp_content, "spl_content" => $verified_spl);

                    }

                    echo json_encode($response);
                }
                else if ($manager_server->getScreenTypeById($_POST["screen_id"]) == "Ingest")
                { */
                $verified_dcp_content = array();
                $ingester_manager = new IngesterManager();
                //$ingester_manager = new IngesterManager(getdb());
                //if ($ingester_manager->isMedia($_POST["screen_id"])) {


                $content = $ingester_manager->getScannedFiles($_POST["screen_id"]);
                foreach ($content as $item) {
                $new_item =  (array) $item;

                    if ($ingester_manager->checkIngestExist($new_item['cpl_id_pack']) == "exists") {
                         $new_item['downloaded_to_tms'] = $ingester_manager->checkDcpIsDownloaded($new_item['cpl_id_pack']);
                        $new_item['current_status'] = $ingester_manager->checkDownloadStatus($new_item['cpl_id_pack']);

                    } else {
                        $new_item['downloaded_to_tms'] = 0;
                        $new_item['current_status'] = 0;
                    }
                     array_push($verified_dcp_content, $new_item);
                }
                //$spl = $ingester_manager->getSplScanByIdServer($_POST["screen_id"]);

                $response = array("session" => 1, "type" => "Ingest", "dcp_content" => $verified_dcp_content, "spl_content" => []);


                echo json_encode($response);

               // }
            }

            if ($_POST['action_control'] == "refresh_server") {


               // $manager_server = new ServerManager(getdb());
                $ingester_manager = new IngesterManager();
                //$server = $manager_server->getServerData($_POST["screen_id"]);
                $server = Ingestsource::find($_POST["screen_id"]) ;


                if ($ingester_manager->checkServerFtpConnection($_POST["screen_id"])) {

                    $ingester_manager->refreshLibrary($_POST["screen_id"], $server->server_ip, $server->usernameServer, $server->passwordServer, $server->path);
                    $verified_dcp_content = array();
                    $content = $ingester_manager->getScannedFiles($_POST["screen_id"]);
                    foreach ($content as $item) {
                       $new_item =  (array) $item;
                        $new_item['downloaded_to_tms'] = $ingester_manager->checkDcpIsDownloaded($new_item['cpl_id_pack']);
                        $new_item['current_status'] = $ingester_manager->checkDownloadStatus($new_item['cpl_id_pack']);
                        array_push($verified_dcp_content, $new_item);
                    }
                   // $spl = $ingester_manager->getSplScanByIdServer($_POST["screen_id"]);

                    $response = array("session" => 1, "type" => "Ingest", "dcp_content" => $verified_dcp_content, "spl_content" => []);
                    echo json_encode($response);
                } else {
                    $response = array("session" => 0, "type" => "Ingest", "dcp_content" => 0, "spl_content" => 0);
                    echo json_encode($response);
                }


            }

            if ($_POST["action_control"] == "start_ingest") {


                $ingester_manager = new IngesterManager();
                $tms_hard_drive = "/DATA";

                $server = Ingestsource::find($_POST["id_source"]) ;
                /*if (!empty($_POST["spl_content"])) {
                    if ($manager_server->getScreenTypeById($_POST["id_source"]) == "Screen") {
                        $session = $server['session_id'];
                        //$soapManagement->login($server['usernameAdmin'], $server['passwordAdmin'], $server['serverName'], $server['managment_ip'], $server['id_server'], getdb());
                        $id_lms = $manager_server->getIdDefaultContent();

                        foreach ($_POST["spl_content"] as $item) {

                            $spl_content = $soapManagement->GetSplContent($session, $server['managment_ip'], $item['uuid']);
                            $spl_content = $spl_content->content;
                            $spl_info = $soapManagement->getSPLInfo($session, $server['managment_ip'], $item['uuid']);
                            $spl_duration = $spl_info->splInfo->duration;
                            $file = $tms_hard_drive . '/spl/' . $item['uuid'] . '.xml';
                            $spl_size = strlen($spl_content);
                            $xml_object = simplexml_load_string($spl_content);
                            if (file_put_contents($file, $spl_content) !== false) {
                            } else {
                                $descrip = "Cant write the spl file " . $xml_object->ShowTitleText . " to location " . $tms_hard_drive . "/spl/ ";
                                saveError2("Ingesting Spl file", 'Failed to write the file.', $server['managment_ip'], $server['serverName'], 0, $server['id_server'], 1, $descrip, "Ingester", getdb());
                            }

                            $downloaded_size = filesize($tms_hard_drive . '/spl/' . $item['uuid'] . ".xml");

                            if ($downloaded_size !== false) {
                                echo "File size: $downloaded_size bytes";
                            } else {
                                echo "Failed to get the file size.";
                            }
                            //  $spl_size=$ingester_manager-> getFileSize($server['server_ip'], "admin", "1234", $item['uri']);
                            $id_spl = uniqid();
                            if ($ingester_manager->checkSplExistByUuid($item['uuid'])) {
                                $ingester_manager->updateDateSpl($item['uuid']);
                            } else {
                                $ingester_manager->insertSpl($id_spl, $item['uuid'], $xml_object->ShowTitleText, $xml_object->AnnotationText, $xml_object->IssueDate, $xml_object->Creator, $item['uri'], $server['serverName'], $spl_duration, $server['id_server'], 0);
                            }
                            // echo filesize("spl_files/".$item['uuid'].".xml");

                            $ingester_manager->updateDataSpl($item['uuid'], $tms_hard_drive . '/spl/' . $item['uuid'] . ".xml", $spl_size);
                            $ingester_manager->updateProgressSpl($item['uuid'], $downloaded_size);

                        }

                    } else {
                        foreach ($_POST["spl_content"] as $item) {
                            $spl_scan_details = $ingester_manager->getSplDetailsScanByUuid($item['uuid'], $_POST["id_source"]);
                            $ingester_manager->deleteLocalSplStorage($item['uuid']);

                            $id_spl = uniqid();

                            $ingester_manager->insertSpl($id_spl, $item['uuid'], $item['description'], $item['description'], $spl_scan_details['IssueDate'], $spl_scan_details['Creator'], $item['uri'], $server['serverName'], $spl_scan_details['duration'], $server['id_server'], 0);
                            $ingester_manager->downloadSplFiles($spl_scan_details, $item['uuid'], $item['uri'], $server["server_ip"], $server['usernameServer'], $server['passwordServer']);

                        }
                    }

                }*/

                if (!empty($_POST["dcp_content"])) {
                    $total_files = array();

                    foreach ($_POST["dcp_content"] as $item) {
                        $id_item = uniqid();
                        $dcp_dir = $ingester_manager->createDcpDirectory($item['cpl_uuid']);
                        $ingester_manager->createDcp($id_item, $item['cpl_uuid'], $item['cpl_description'], $item['is3D'], $item['cpl_uri'],
                            $item['pkl_uuid'], $item['pkl_description'], $item['pkl_uri'],
                            $item['asset_uuid'], $item['asset_description'], $item['asset_uri'],
                            $_POST["id_source"], $server['serverName'], "pending", $dcp_dir,
                            $server['usernameServer'], $server['passwordServer'], $server['server_ip']);

                        $tms_cpl_path = $ingester_manager->downloadCplFile($id_item, $item['cpl_uuid'], $item['cpl_uri'], $server['server_ip'], $server['usernameServer'], $server['passwordServer'], $dcp_dir, "cpl_progress", $server['remotPath'], $_POST["id_source"]);

                        if ($item['multiple_asset'] == 0) {
                            $tms_asset_path = $ingester_manager->downloadAssetFile($id_item, $item['cpl_uuid'], $item['asset_uri'], $server['server_ip'], $server['usernameServer'], $server['passwordServer'], $dcp_dir, "asset_progress", $server['remotPath'], $_POST["id_source"]);

                        } else {
                            $tms_asset_path = $item['asset_uri'];
                        }
                        $tms_pkl_path = $ingester_manager->downloadPklFile($id_item, $item['cpl_uuid'], $item['pkl_uri'], $server['server_ip'], $server['usernameServer'], $server['passwordServer'], $dcp_dir, "pkl_progress", $server['remotPath'], $_POST["id_source"], $_POST["id_source"]);

                        //get cpl infos
                        $cpl_content = $ingester_manager->loadCpl($tms_cpl_path);
                        $ingester_manager->insertCplData($item['cpl_uuid'], $cpl_content['ContentKind']);

                        // get mxf files
                        $pkl_content = $ingester_manager->loadPkl($tms_pkl_path);
                        if ($ingester_manager->checkIsArrayOfArrays($pkl_content)) {

                        } else {
                         $pkl_content = $ingester_manager->convertToArrayOfArrays($pkl_content);
                        }
                        $pkl_uuid = $ingester_manager->getPklUuid($item['cpl_uuid']);

                        if ($ingester_manager->checkPathFromPkl($pkl_content) == 1) { // if from pkl
                            $asset_content = $ingester_manager->loadAssetMap($tms_asset_path, $dcp_dir, $item['asset_uri']);
                            if ($ingester_manager->checkAssetHasPath($asset_content) == 1) {
                                $file_mxf = $ingester_manager->getLargesFilesFromPklAndAssetPath($pkl_content, $asset_content);
                            } else {
                                $file_mxf = $ingester_manager->getLargesFilesFromPkl($pkl_content);
                            }
                        } else { //else from assetMap file
                            $asset_content = $ingester_manager->loadAssetMap($tms_asset_path, $dcp_dir, $item['asset_uri']);
                            $file_mxf = $ingester_manager->getLargesFilesFromAssetMap($asset_content, $pkl_content, $pkl_uuid);
                        }
                        //if (empty($file_mxf)) {
                        if (empty($file_mxf) or (count($file_mxf) === 1 && $file_mxf[0]['Type'] === 'text/xml;asdcpKind=CPL')){
                            $ingester_manager->updateIngestStatusByCplUuid($item['cpl_uuid'], "Complete");

                            /* ************ check this ***** */
                            $ingester_manager->updateIngestCplData($item['cpl_uuid']);
                            /* ************************************ */
                        } else {
                            //create download mxf
                            $mxf_files_by_cpl = array();
                            foreach ($file_mxf as $asset) {

                                $id_large_file = uniqid();
                                if (!$ingester_manager->checkDcpItemExist($asset['Id'], $item['cpl_uuid'])) {
                                    $ingester_manager->createDcpLargeFile($id_large_file, $asset['Id'], $asset['Hash'], $asset['size'], $asset['Type'], $asset['file_name'], $dcp_dir, $id_item, $item['cpl_uuid'], $_POST["id_source"], $server['serverName']);
                                    $d = array("id_large_file" => $id_large_file, "size" => $asset['size'], "Id" => $asset['Id'], "OriginalFileName" => $asset['file_name'],
                                        "tms_dir" => $dcp_dir, "id_item" => $id_item, "cpl_uuid" => $item['cpl_uuid'], "pkl_uri" => $item['pkl_uri'], "id_server" => $_POST["id_source"]);
                                    array_push($mxf_files_by_cpl, $d);
                                } else {
                                    $mxf_data = $ingester_manager->getMxfData($asset['Id'], $item['cpl_uuid']);
                                    if ($mxf_data['OriginalFileName'] == $asset['file_name']) {

                                    } else {
                                        $ingester_manager->updateDcpLargeFile($asset['Id'], $asset['file_name'], $item['cpl_uuid']);
                                        if (rename($mxf_data['tms_dir'] . '/' . $mxf_data['OriginalFileName'], $dcp_dir . '/' . $asset['file_name'])) {
                                            echo 'File renamed successfully.';
                                        } else {
                                            echo '--------------------------------------';
                                            echo "file not found  - id : " . $asset['Id'];
                                            echo 'Error renaming the file.';
                                            echo '--------------------------------------';
                                        }
                                    }
                                }
                            }
                        }

                    }
                }
            }

            if ($_POST["action_control"] == "monitor") {
                $ingester_manager = new IngesterManager();
                $response = array("running" => $ingester_manager->getRunningIngests(), "pending" => $ingester_manager->getPendingIngests());
                //$ingester_manager->displayMonitoring();
                echo json_encode($response);
            }

            if ($_POST["action_control"] == "cancel_ingest") {
                $ingester_manager = new IngesterManager();
                $ingester_manager->updateDownloadStatusByIdCpl($_POST["idCpl"], "Canceled By User");
                $tms_dir = $ingester_manager->getDcpTmsDirByCplUuid($_POST["idCpl"]);
                sleep(1);
                $ingester_manager->removeDcpFiles($tms_dir);
                $ingester_manager->deleteMxfByCplUuid($_POST["idCpl"]);

            }
            if ($_POST["action_control"] == "details_ingest") {
                $ingester_manager = new IngesterManager();
                $response =   $ingester_manager->getDcpLogsDetails($_POST["idCpl"]);
                echo json_encode($response);
            }

            if ($_POST["action_control"] == "get_logs") {
                $ingester_manager = new IngesterManager();
                //$response = array("dcp" => $ingester_manager->getDcpLogs(), "spl" => $ingester_manager->getSplLogs());
                $response = array("dcp" => $ingester_manager->getDcpLogs(), "spl" => []);
                echo json_encode($response);
            }
            if ($_POST["action_control"] == "get_transfere_content") {
                $ingester_manager = new IngesterManager();
                //$response = array("dcp" => $ingester_manager->getDcpLogs(), "spl" => $ingester_manager->getSplLogs());
                $response = array("dcp" => $ingester_manager->get_transfere_content(), "spl" => []);
                echo json_encode($response);
            }

            if ($_POST["action_control"] == "delete_scan_logs") {
                $ingester_manager = new IngesterManager();
                foreach ($_POST["array_logs"] as $id) {
                    $ingester_manager-> DeleteLogsById($id);
                }
            }
            if ($_POST["action_control"] == "get_scan_errors") {
             //$manager_server = new ServerManager(getdb());
                $ingester_manager = new IngesterManager();
               $response= $ingester_manager->getErrorsScan();
                    echo json_encode($response);
            }

        }


    }


    public function transfere_content()
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }
        return view('ingester.transfere_content', compact('locations'));
    }

     public function delete_transfered_file(Request $request)
    {

        foreach($request->array_files as $file)
        {

            $file_to_delete = DB::table('ingests')
            ->where('cpl_id',$file)
            ->first();

            $command = "rm -rf $file_to_delete->tms_dir";
            $output = shell_exec($command);
            $result = true;
            if ($output === null)
            {
                 DB::table('ingest_dcp_large')
                ->where('id_cpl',$file)->delete() ;

                DB::table('ingests')
                    ->where('cpl_id',$file)->delete() ;

              //  return true; // Successfully deleted

            }
            else
            {
                $result =false ;
               // return false; // Failed to delete
            }

        }
        return $result ;

    }

    public function generate_torrent_file(Request $request)
    {
        $ingest_success = array() ;
        $ingest_errors = array();
        $ingest_status= array();
        $location = Location::find($request->location) ;
        try
        {
            foreach ($request->array_files as $file )
            {
                $cpl = $result = DB::table('ingests')
                    ->where('cpl_id', $file)
                    ->first();

                if($cpl)
                {
                    $pkl_size = $this->getFolderSize($cpl->tms_dir);

                    $response = $this->ingestDcp($location->connection_ip,$cpl->cpl_id, $pkl_size, $cpl->cpl_description,$location->email, $location->password);
                    dd($response) ;
                    if($response['status'] === 1 )
                    {

                        Dcp_trensfer::updateOrCreate([
                            'id_cpl' => $cpl->cpl_id ,
                            'location_id' => $location->id
                        ],[
                            'status'     =>"Pending",
                            "torrent_path" =>$response['dcp_path'],
                            'pkl_size' => $pkl_size ,
                            "source" =>$cpl->tms_dir,
                            "progress" => 0 ,
                            "id_ingest"=> $cpl->id,
                            "id_cpl" => $cpl->cpl_id,
                            'location_id' => $location->id
                        ]);
                        array_push($ingest_success,  array("status" => 1, "pkl_description" =>  $cpl->pkl_description , "message" =>  "DCP Ingested successfully" , "id" =>  $cpl->id ));
                    }
                    else
                    {
                        array_push($ingest_errors,  array("status" => 0, "pkl_description" =>  $cpl->pkl_description, "message" =>  $response['result'], "id" =>  $cpl->id ));
                    }
                }
            }
            $ingest_status = array("status" => 1,  "message " => "") ;
            return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
        } catch (Exception $e) {
            $ingest_status = array("status" => 0 , "message " => $e->getMessage()) ;
            return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
            echo "Failed" ;

        }

    }

        public function generate_torrent_file_multi_locations(Request $request)
    {
        $ingest_success = array() ;
        $ingest_errors = array();
        $ingest_status= array();

        //$locations_of_spl = Location::whereIn('id',$request->id_location)->get();
        $locations = Location::whereIn('id',$request->locations)->get();
        foreach($locations as $location)
        {
            //$location = Location::find($request->location) ;
            try
            {
                foreach ($request->array_files as $file )
                {
                    $cpl = $result = DB::table('ingests')
                        ->where('cpl_id', $file)
                        ->first();

                    if($cpl)
                    {
                        $pkl_size = $this->getFolderSize($cpl->tms_dir);

                        $response = $this->ingestDcp($location->connection_ip,$cpl->cpl_id, $pkl_size, $cpl->cpl_description,$location->email, $location->password);
                        if($response['status'] === 1 )
                        {

                            Dcp_trensfer::updateOrCreate([
                                'id_cpl' => $cpl->cpl_id ,
                                'location_id' => $location->id
                            ],[
                                'status'     =>"Pending",
                                "torrent_path" =>$response['dcp_path'],
                                'pkl_size' => $pkl_size ,
                                "source" =>$cpl->tms_dir,
                                "progress" => 0 ,
                                "id_ingest"=> $cpl->id,
                                "id_cpl" => $cpl->cpl_id,
                                'location_id' => $location->id
                            ]);
                            array_push($ingest_success,  array("status" => 1, "pkl_description" =>  $cpl->pkl_description , "message" =>  "DCP Ingested successfully" , "id" =>  $cpl->id ));
                        }
                        else
                        {
                            array_push($ingest_errors,  array("status" => 0, "pkl_description" =>  $cpl->pkl_description, "message" =>  $response['result'], "id" =>  $cpl->id ));
                        }
                    }
                }
                $ingest_status = array("status" => 1,  "message " => "") ;
                return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
            } catch (Exception $e) {
                $ingest_status = array("status" => 0 , "message " => $e->getMessage()) ;
                return Response()->json(compact('ingest_errors','ingest_success','ingest_status'));
                echo "Failed" ;

            }
        }
    }


    public function ingestDcp($apiUrl,$cpl_uuid, $dcp_size, $title,$username, $password)
    {
        // Prepare the request data
        $requestData = [
            'action' => 'ingestDcp',
            'username' => $username,
            'password' => $password,
            'cpl_uuid' => $cpl_uuid,
            'dcp_size' => $dcp_size,
            'title' => $title,
        ];
        // Initialize cURL session
        $ch = curl_init($apiUrl);
        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Curl error: ' . curl_error($ch)];
        }
        // Close cURL session
        curl_close($ch);

        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            return json_decode($response, true);
        }
    }

    function getFolderSize($folder) {
        $totalSize = 0;
        $directoryIterator = new RecursiveDirectoryIterator($folder, RecursiveDirectoryIterator::SKIP_DOTS);
        $recursiveIterator = new RecursiveIteratorIterator($directoryIterator);

        foreach ($recursiveIterator as $file) {
            if ($file->isFile()) {
                $totalSize += $file->getSize();
            }
        }
        return $totalSize;
    }

    public function logs( Request $request)
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }
        $dcp_trensfers = Dcp_trensfer::
            leftJoin('ingests', 'dcp_trensfers.id_ingest', '=', 'ingests.id')
            ->leftJoin('locations', 'dcp_trensfers.location_id', '=', 'locations.id')
            ->where(function ($query) {
            $query->where('dcp_trensfers.status', '=','Completed' )
                  ->orWhere('dcp_trensfers.status', '=', "Failed");
                })
                ->select('dcp_trensfers.*','ingests.cpl_description','locations.name') ;

            if($request->location_log != "null")
            {
                $dcp_trensfers =$dcp_trensfers->where('dcp_trensfers.location_id', '=',$request->location_log) ;
            }
            if($request->state_log != "all")
            {
                $dcp_trensfers =$dcp_trensfers->where('dcp_trensfers.status', '=',$request->state_log) ;
            }
            $dcp_trensfers =$dcp_trensfers->get();
        return Response()->json(compact('dcp_trensfers','locations'));
    }

    public function monitors()
    {
        $dcp_trensfers = Dcp_trensfer::
            leftJoin('ingests', 'dcp_trensfers.id_ingest', '=', 'ingests.id')
            ->leftJoin('locations', 'dcp_trensfers.location_id', '=', 'locations.id')
            ->where(function ($query) {
            $query->where('dcp_trensfers.status', '=','Running' )
                  ->orWhere('dcp_trensfers.status', '=', "Pending");
                })
                ->select('dcp_trensfers.*','ingests.cpl_description','locations.name')
                ->get();

        return Response()->json(compact('dcp_trensfers'));

    }

    public function logs_details( Request $request)
    {
        $id =$request->id ;

        $dcp_trensfer = Dcp_trensfer::
        leftJoin('ingests', 'dcp_trensfers.id_ingest', '=', 'ingests.id')
        ->leftJoin('locations', 'dcp_trensfers.location_id', '=', 'locations.id')
        ->where('dcp_trensfers.id',$id)
        ->select('dcp_trensfers.*','ingests.cpl_description','ingests.cpl_id','locations.name')
        ->first();
        return Response()->json(compact('dcp_trensfer'));
    }

}
