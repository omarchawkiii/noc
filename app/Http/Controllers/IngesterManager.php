<?php

namespace App\Http\Controllers;

use App\Models\Ingestsource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;

class IngesterManager extends Controller
{
    private $_db; // Instance de PDO

    // Instance de PDO
   /* public function __construct($db)
    {
        $this->setDb($db);
    }*/

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    //ftp connections
    public function getConnection($host, $user, $password)
    {

        try {
            $ftpConn = ftp_connect($host, 21);

            if ($ftpConn != false) {
                ftp_pasv($ftpConn, true);
                $login = ftp_login($ftpConn, $user, $password);
                if ((!$ftpConn) || (!$login)) {
                    return null;
                } else {
                    return $ftpConn;
                }
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $e->getMessage();
            return null;
        }

    }

    public function close($connection)
    {
        ftp_close($connection);

    }



    /*public function getScreenTypeById($id_server)
    {
        $q = $this
            ->_db
            ->prepare('SELECT serverType FROM  server where idserver = ? ');

        try {
            $q->execute(array($id_server));
            $result = $q->fetch();
            return $result['serverType'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }*/

    public function downloadCplFile($id, $uuid, $uri, $server_ip, $username, $password, $dcp_dir, $type, $path, $id_source)
    {

        $url = 'ftp://' . $username . ':' . $password . '@' . $server_ip . '/' . $uri;
        $file_path = $dcp_dir . '/' . basename($uri);
        $hout = fopen($file_path, "wb") or die("Cannot open destination file");

        //  $hout = fopen(  $tms_dir . '/' . basename($uri), "wb") or die("Cannot open destination file");
        //        chmod("./content_ingested/" . $tms_dir, 0777);
        $hin = fopen($url, "rb") or die("Cannot open source file");
        while (!feof($hin)) {
            $buf = fread($hin, 2024);
            fwrite($hout, $buf);
            $p = intval(ftell($hin));
            $this->updateProgress($id, $type, $p);
        }
        fclose($hin);
        fclose($hout);
        return $file_path;
    }

    public function downloadPklFile($id, $uuid, $uri, $server_ip, $username, $password, $dcp_dir, $type, $path,$id_source)
    {

        $url = 'ftp://' . $username . ':' . $password . '@' . $server_ip . '/' . $uri;
        $file_path = $dcp_dir . '/' . basename($uri);
        $hout = fopen($file_path, "wb") or die("Cannot open destination file");

        // $hout = fopen(  $tms_dir . '/' . basename($uri), "wb") or die("Cannot open destination file");
        //        chmod("./content_ingested/" . $tms_dir, 0777);
        $hin = fopen($url, "rb") or die("Cannot open source file");
        while (!feof($hin)) {
            $buf = fread($hin, 2024);
            fwrite($hout, $buf);
            $p = intval(ftell($hin));
            $this->updateProgress($id, $type, $p);
        }

        fclose($hin);
        fclose($hout);
        return $file_path;

    }

    public function loadCpl($tms_cpl_path)
    {

        $asset_file = simplexml_load_string(file_get_contents(($this->removeQuot($tms_cpl_path))));
        $array_asset = json_decode(json_encode((array)$asset_file), TRUE);
        return $array_asset;

    }

    public function loadPkl($tms_pkl_path)
    {

        $asset_file = simplexml_load_string(file_get_contents(($this->removeQuot($tms_pkl_path))));
        $array_asset = json_decode(json_encode((array)$asset_file), TRUE);
        return $array_asset['AssetList']['Asset'];

    }

    public function getPklUuid($cpl_uuid)
    {

        $result =  DB::table('ingests')
        ->where('cpl_id', $cpl_uuid)
        ->select('ingests.pkl_id')
        ->first();

        return $result->pkl_id ;

        /*$q = $this
            ->_db
            ->prepare('SELECT pkl_id  FROM  ingests where cpl_id = ? ');

        try {
            $q->execute(array($cpl_uuid));
            $result = $q->fetch();
            return $result['pkl_id'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/

        return Null;
    }

    public function checkPathFromPkl($my_asset)
    {

        $v = 0;
        if (array_key_exists("OriginalFileName", $my_asset)) {
            return 1;
        } else {
            $v = 0;
        }
        //        foreach ($my_asset as $item_parent) {
        //            if (array_key_exists("OriginalFileName", $item_parent)) {
        //                return 1;
        //            } else {
        //                $v = 0;
        //            }
        //        }
        return $v;
    }

    public function insertCplData($cpl_uuid, $ContentKind)
    {


        $this->DeleteCplByUuidCpl($cpl_uuid);


        DB::table('cpl_data')->insert(
            [
                'id' => uniqid() ,
                'uuid' => $cpl_uuid ,
                'ContentKind' => $ContentKind ,
            ]
        );

        /*$q = $this->_db->prepare("INSERT INTO cpl_data (id,uuid,ContentKind ) VALUES (?,?,?)");
        try {
            $q->execute([uniqid() . $cpl_uuid, $cpl_uuid, $ContentKind]);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/


    }

    public function DeleteCplByUuidCpl($uuid_cpl)
    {
        DB::table('cpl_data')
                ->where('uuid', $uuid_cpl)
                ->delete();

        /*$q2 = $this->_db->prepare('DELETE  FROM cpl_data   WHERE cpl_data.uuid = :uuid');
        try {
            $q2->execute(array(':uuid' => $uuid_cpl));
        } catch (PDOException $e) {
        }*/
    }

    public function loadAssetMap($tms_asset_path, $tms_dir, $assetMap)
    {
        // $url = "./content_ingested/" . $tms_dir . '/' . basename($assetMap);
        $asset_file = simplexml_load_string(file_get_contents(($this->removeQuot($tms_asset_path))));
        $array_asset = json_decode(json_encode((array)$asset_file), TRUE);
        return $array_asset['AssetList']['Asset'];

    }

    function isArrayArrayOfArrays($array)
    {
        if (empty($array) || !is_array($array)) {
            return false; // If the input is not an array or empty, it's not an array of arrays
        }

        foreach ($array as $element) {
            if (!is_array($element)) {
                return false; // If any element is not an array, it's not an array of arrays
            }
        }

        return true; // All elements are arrays, so it's an array of arrays
    }

    public function getLargesFilesFromPklAndAssetPath($my_assets, $array_asset_file)
    {

        if ($this->checkAssetHasPath($array_asset_file) == 1) {
            $file_mxf = array();
            if ($this->isArrayArrayOfArrays($my_assets)) {
                foreach ($my_assets as $asset_item) {
                    // if (!(pathinfo($asset_item['OriginalFileName'], PATHINFO_EXTENSION) == "xml")) {
                    if ($asset_item['Type'] != "text/xml;asdcpKind=CPL") {
                        $path_file = $this->removeQuot($asset_item['OriginalFileName']);
                        foreach ($array_asset_file as $asset) {  // Iterate over $array_asset directly
                            if ($asset_item['Id'] == $asset['Id']) {
                                $path_file = $this->removeQuot($asset['ChunkList']['Chunk']['Path']);
                            }
                        }
                        $a = array(
                            "Id" => $asset_item['Id'],
                            "Hash" => $asset_item['Hash'],
                            "size" => $asset_item['Size'],
                            "Type" => $asset_item['Type'],
                            "file_name" => $path_file
                        );
                        array_push($file_mxf, $a);
                    }
                }
            } else {
                if ($my_assets['Type'] != "text/xml;asdcpKind=CPL") {
                    $path_file = $this->removeQuot($my_assets['OriginalFileName']);
                    foreach ($array_asset_file as $asset) {  // Iterate over $array_asset directly
                        if ($my_assets['Id'] == $asset['Id']) {
                            $my_assets = $this->removeQuot($asset['ChunkList']['Chunk']['Path']);
                        }
                    }
                    $a = array(
                        "Id" => $my_assets['Id'],
                        "Hash" => $my_assets['Hash'],
                        "size" => $my_assets['Size'],
                        "Type" => $my_assets['Type'],
                        "file_name" => $path_file
                    );
                    array_push($file_mxf, $a);
                }
            }

        } else {
            $file_mxf = array();
            foreach ($my_assets as $asset_item) {
                // if (!(pathinfo($asset_item['OriginalFileName'], PATHINFO_EXTENSION) == "xml")) {
                if ($asset_item['Type'] != "text/xml;asdcpKind=CPL") {

                    $a = array(
                        "Id" => $asset_item['Id'],
                        "Hash" => $asset_item['Hash'],
                        "size" => $asset_item['Size'],
                        "Type" => $asset_item['Type'],
                        "file_name" => $this->removeQuot($asset_item['OriginalFileName'])
                    );
                    array_push($file_mxf, $a);
                }
            }
        }


        return $file_mxf;
    }

    public function getSizeFromPkl($my_asset)
    {

        $items = array();

        foreach ($my_asset as $asset_item) {
            if(isset($asset_item['Hash'])){
                $hash=  $asset_item['Hash'] ;
            }else{
                $hash="unknown";
            }
            $p = array("id" => $asset_item['Id'], "size" => $asset_item['Size'],
                "Hash" => $hash, "Type" => $asset_item['Type']);
            array_push($items, $p);
        }
        return $items;
    }

    public function getLargesFilesFromPkl($my_assets)
    {
        $file_mxf = array();
        foreach ($my_assets as $asset_item) {
            // if (!(pathinfo($asset_item['OriginalFileName'], PATHINFO_EXTENSION) == "xml")) {
            if ($asset_item['Type'] != "text/xml;asdcpKind=CPL") {
                $a = array(
                    "Id" => $asset_item['Id'],
                    "Hash" => $asset_item['Hash'],
                    "size" => $asset_item['Size'],
                    "Type" => $asset_item['Type'],
                    "file_name" => $this->removeQuot($asset_item['OriginalFileName'])
                );
                array_push($file_mxf, $a);
            }
        }
        return $file_mxf;
    }

    public function getLargesFilesFromAssetMap($my_assets, $pkl_content, $pkl_uuid)
    {
        $file_mxf = array();
        foreach ($my_assets as $asset_item) {
            if (!array_key_exists("Length", $asset_item['ChunkList'])) {
                foreach ($this->getSizeFromPkl($pkl_content) as $item) {
                    if ($item['id'] == $asset_item['Id']) {
                        $size = $item['size'];

                        if(isset($item['Hash'])){
                            $hash = $item['Hash'];
                        }else{
                            $hash = "unknown";
                        }
                        $Type = $item['Type'];
                    }
                }
            } else {
                $size = $asset_item['ChunkList']['Chunk']['Length'];
                $hash = "unknown";

            }
            if ($asset_item['Id'] != $pkl_uuid) {
                $a = array(
                    "Id" => $asset_item['Id'],
                    "Hash" => $hash,
                    "size" => $size,
                    // "size" => $asset_item['ChunkList']['Chunk']['Length'],
                    "Type" => $Type,
                    "file_name" => $this->removeQuot($asset_item['ChunkList']['Chunk']['Path'])
                );
                array_push($file_mxf, $a);
            }
        //            if (!(pathinfo($asset_item['ChunkList']['Chunk']['Path'], PATHINFO_EXTENSION) == "xml")) {
        //                $a = array(
        //                    "Id" => $asset_item['Id'],
        //                    "Hash" => $hash,
        //                    "size" => $size,
        //                    // "size" => $asset_item['ChunkList']['Chunk']['Length'],
        //                    "Type" => $Type,
        //                    "file_name" => $this->removeQuot($asset_item['ChunkList']['Chunk']['Path'])
        //                );
        //                array_push($file_mxf, $a);
        //            }
        }
        return $file_mxf;
    }

    public function checkDcpItemExist($Id, $id_cpl)
    {
        echo $Id . '-----------' . $id_cpl . '-----';


        $res =  DB::table('ingest_dcp_large')
        ->where('Id', $Id)
        ->where('id_cpl', $id_cpl)
        ->get();
        echo "testt---";
        echo count($res) ;

        if (count($res) > 0) {
            return true ;
        } else {
            // Handle query error
            return false;
        }
        /*
        $q = $this
            ->_db
            ->prepare('SELECT  count(*)  FROM ingest_dcp_large WHERE  Id  = ? AND id_cpl=? ');
        try {
            $q->execute(array($Id, $id_cpl));
            $count = $q->fetchColumn();
            echo "testt---";
            echo($count);
            echo "----";
            return $count > 0;

        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }*/

    }

    public function checkAssetHasPath($array_asset)
    {

        foreach ($array_asset as $asset_item) {
            if (!array_key_exists("Path", $asset_item['ChunkList'])) {
                return 1;
            } else {
                return 0;
            }
        }

    }

    public function downloadAssetFile($id, $uuid, $uri, $server_ip, $username, $password, $dcp_dir, $type, $path,$id_source)
    {


        $url = 'ftp://' . $username . ':' . $password . '@' . $server_ip . '/' . $uri;

        if (substr($uri, -4) !== ".xml") {
            $uri .= ".xml";
        }
        $file_path = $dcp_dir . '/' . basename($uri);

        $hout = fopen($file_path, "wb") or die("Cannot open destination file");

        // $hout = fopen(  $tms_dir . '/' . basename($uri), "wb") or die("Cannot open destination file");
        //        chmod("./content_ingested/" . $tms_dir, 0777);
        $hin = fopen($url, "rb") or die("Cannot open source file");
        while (!feof($hin)) {
            $buf = fread($hin, 2024);
            fwrite($hout, $buf);
            $p = intval(ftell($hin));
            $this->updateProgress($id, $type, $p);
        }
        fclose($hin);
        fclose($hout);
        return $file_path;
    }

    public function createDcpLargeFile($id_file, $Id, $Hash, $Size, $Type, $OriginalFileName, $tms_dir, $id_ingests, $cpl_id, $id_server, $name_source)
    {
        if ($Id != $cpl_id) {


            $date_create_ingest = date('Y-m-d H:i:s');

            DB::table('ingest_dcp_large')->insert(
                [
                    'id_file'=> $id_file ,
                    'Id' => $Id ,
                    'Hash' => $Hash ,
                    'Size' => $Size ,
                    'Type' => $Type ,
                     'OriginalFileName' => $OriginalFileName ,
                    'tms_dir' => $tms_dir ,
                    'id_ingests' => $id_ingests ,
                     'id_cpl' => $cpl_id ,
                     'id_server' => $id_server ,
                    'date_create_ingest' => $date_create_ingest ,
                ]
            );


            // $tms_dir = $this->getPathFolder(str_replace(' ', '', $name_source) . '_' . (substr($cpl_id, 9)), "dcp");
            /*$q = $this->_db->prepare("INSERT INTO ingest_dcp_large (id_file,Id,Hash,Size,Type, OriginalFileName,tms_dir,id_ingests, id_cpl, id_server,date_create_ingest  ) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            try {
                $q->execute([$id_file, $Id, $Hash, $Size, $Type, $OriginalFileName, $tms_dir, $id_ingests, $cpl_id, $id_server, $date_create_ingest]);

                return $tms_dir;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }*/
        }

    }

    public function getMxfData($id_file, $cpl_uuid)
    {

        $result =  DB::table('ingest_dcp_large')
        ->where('Id', $id_file)
        ->where('id_cpl', $cpl_uuid)
        ->select('OriginalFileName','tms_dir')
        ->get();

        if (count($result) > 0) {
            return $result;
        } else {

        }
        /*
        $q = $this->_db->prepare('SELECT  OriginalFileName,tms_dir  FROM ingest_dcp_large WHERE  Id  = ? AND id_cpl = ?  ');
        try {
            $q->execute(array($id_file, $cpl_uuid));
            $result = $q->fetch();
            if ($result) {
                return $result;
            } else {

                // Handle the case where no rows were found in the query.
                // You might want to return a default value or throw an exception.
                // Example: return 'File not found';
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        */
    }

    public function updateDcpLargeFile($id_file, $OriginalFileName, $cpl_id)
    {

        $date_update_ingest = date('Y-m-d H:i:s');

        DB::table('ingest_dcp_large')
        ->where('Id', $id_file)
        ->where('id_cpl', $cpl_id)
        ->update(array('OriginalFileName' => $OriginalFileName , 'date_create_ingest' => $date_update_ingest ));

       /* $data = [
            'OriginalFileName' => $OriginalFileName,
            'Id' => $id_file,
            'id_cpl' => $cpl_id,
            'date_create_ingest' => $date_update_ingest
        ];
        $sql = "UPDATE ingest_dcp_large
                SET OriginalFileName=:OriginalFileName,date_create_ingest=:date_create_ingest
                WHERE Id=:Id AND id_cpl=:id_cpl";
        $q = $this
            ->_db
            ->prepare($sql);

        $q->execute($data);*/
    }

    public function updateProgress($id, $type_file_progress, $progress)
    {
        $currentDateTime = date('Y-m-d H:i:s');
        //        $adjustedDateTime = date('Y-m-d H:i:s', strtotime($currentDateTime . ' +8 hours'));
        /*$q = $this
            ->_db->prepare('UPDATE ingests SET ' . $type_file_progress . ' = ?,  date_create_ingest = ? WHERE id = ?  ');
        $q->execute([$progress, $currentDateTime, $id]);*/


        DB::table('ingests')
        ->where('id', $id)
        ->update(array($type_file_progress => $progress , 'date_create_ingest' => $currentDateTime ));

    }

    public function DeleteDcpByUuidCpl($uuid_cpl)
    {
        print_r($uuid_cpl);
        DB::table('ingests')
                ->where('cpl_id', $uuid_cpl)
                ->delete();

        /*$q2 = $this->_db->prepare('DELETE  FROM ingests   WHERE ingests.cpl_id = :cpl_id');
        try {
            $q2->execute(array(':cpl_id' => $uuid_cpl));
        } catch (PDOException $e) {
        }*/
    }

        public function createDcp($id, $cpl_id, $cpl_description, $is3D, $cpl_uri, $pkl_id, $pkl_description, $pkl_uri, $asset_id, $asset_description, $asset_uri, $id_source, $name_source, $status, $dcp_dir, $ftp_username, $ftp_password, $ip)
    {
        $cpl_size = 0;// $this->getFileSize($ip, $ftp_username, $ftp_password, $cpl_uri);
        $pkl_size = 0;// $this->getFileSize($ip, $ftp_username, $ftp_password, $pkl_uri);
        $asset_size = 0;// $this->getFileSize($ip, $ftp_username, $ftp_password, $asset_uri);
        // $tms_dir = $this->getPathFolder(str_replace(' ', '', $name_source) . '_' . (substr($cpl_id, 9)), "dcp");
        // $tms_dir = '/data/assets/' . (substr($cpl_id, 9));
        $this->DeleteDcpByUuidCpl($cpl_id);


        $date_create_ingest = date('Y-m-d H:i:s');
        echo $date_create_ingest . '-----';

        /*$q = $this->_db->prepare("INSERT INTO ingests (id,cpl_id,cpl_description,is3D,cpl_uri,cpl_size,pkl_id, pkl_description,pkl_uri,pkl_size, asset_id, asset_description, asset_uri,asset_size,id_source,name_source,tms_dir,date_create_ingest,status ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        try {
            $q->execute([$id, $cpl_id, $cpl_description, $is3D, $cpl_uri, $cpl_size, $pkl_id, $pkl_description, $pkl_uri, $pkl_size, $asset_id, $asset_description, $asset_uri, $asset_size, $id_source, $name_source, $dcp_dir, $date_create_ingest, $status]);
            // return $tms_dir;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        */
        DB::table('ingests')->insert(
            [
                'id' => $id ,
                'cpl_id' => $cpl_id ,
                'cpl_description' => $cpl_description ,
                'is3D' => $is3D ,
                'cpl_uri' => $cpl_uri ,
                'cpl_size' => $cpl_size ,
                'pkl_id' => $pkl_id ,
                'pkl_description' => $pkl_description ,
                'pkl_uri' => $pkl_uri ,
                'pkl_size' => $pkl_size ,
                'asset_id' => $asset_id ,
                'asset_description' => $asset_description ,
                'asset_uri' => $asset_uri ,
                'asset_size' => $asset_size ,
                'id_source' => $id_source ,
                'name_source' => $name_source ,
                'tms_dir' => $dcp_dir ,
                'date_create_ingest' => $date_create_ingest ,
                'status'  => $status ,
            ]
        );


    }

    public function createDcpDirectory($cpl_id)
    {
        $tms_hard_drive = "/DATA";
        $folder_name = (substr($cpl_id, 9));//remove "urn:uuid:" from uuid cpl
        if (!is_dir($tms_hard_drive . '/assets/' . $folder_name)) {
            //Directory does not exist,   create it.
            mkdir($tms_hard_drive . '/assets/' . $folder_name, 0777);
            chmod($tms_hard_drive . '/assets/' . $folder_name, 0777);
        }
        return $tms_hard_drive . '/assets/' . $folder_name;
    }

    public function createDcpTmpDirectory($cpl_id)
    {
        $tms_hard_drive = "/DATA";
        $folder_name = (substr($cpl_id, 9));//remove "urn:uuid:" from uuid cpl
        if (!is_dir($tms_hard_drive . '/tmp/' . $folder_name)) {
            //Directory does not exist,   create it.
            mkdir($tms_hard_drive . '/tmp/' . $folder_name, 0777);
            chmod($tms_hard_drive . '/tmp/' . $folder_name, 0777);
        }
        return $tms_hard_drive . '/tmp/' . $folder_name;
    }

    public function generateUuid()
    {
        $data = openssl_random_pseudo_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0F | 0x40); // Set version (4 bits)
        $data[8] = chr(ord($data[8]) & 0x3F | 0x80); // Set bits 6-7 to 10

        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        return 'urn:uuid:' . $uuid;
    }

    public function removeFiles($id, $id_server)
    {

        DB::table('scanned_libraries')
                ->where('id', $id)
                ->where('id_server', $id_server)
                ->delete();


        /*$query = "DELETE from scanned_libraries WHERE id=:id AND id_server=:id_server ";

        $statement = $this->_db->prepare($query);
        $statement->execute(array(':id' => $id, ':id_server' => $id_server));*/
    }

    public function generateAsset($pkl_file_name, $pkl, $uuid_asset, $generale_asset)
    {

        $file = ' <AssetMap xmlns="http://www.smpte-ra.org/schemas/429-9/2007/AM">
                  <Id>' . $uuid_asset . '</Id>
                    <AnnotationText>' . $pkl->AnnotationText . '</AnnotationText>
                    <Creator>TMS</Creator>
                    <VolumeCount>1</VolumeCount>
                     <IssueDate>TMS</IssueDate>
                      <Issuer>TMS</Issuer>
                      <AssetList>';
        foreach ($pkl->AssetList->Asset as $asset_pkl) {
            $item_uuid = (string)$asset_pkl->Id;
            foreach ($generale_asset as $asset_item2) {
                if ($asset_item2['Id'] === $item_uuid) {

                    $chunk = $asset_item2['ChunkList']['Chunk'];
                    $path = $chunk['Path'];
                    // $Length = $chunk['Length'];
                    $Length = (string)$asset_pkl->Size;
                    $file .= "<Asset>
                               <Id>" . $asset_item2['Id'] . "</Id>
                               <ChunkList>
                                 <Chunk>
                                  <Path>" . $path . "</Path>
                                  <VolumeIndex>1</VolumeIndex>
                                  <Offset>0</Offset>
                                  <Length>" . $Length . "</Length>
                                </Chunk>
                               </ChunkList>
                            </Asset>";
                }
            }

        }
        $file .= "<Asset>
                   <Id>" . $pkl->Id . "</Id>
                    <PackingList/>
                    <ChunkList>
                    <Chunk>
                      <Path>" . $pkl_file_name . "</Path>
                     <VolumeIndex>1</VolumeIndex>
                   </Chunk>
                 </ChunkList>
              </Asset>";
        $file .= "</AssetList>
                    </AssetMap>";
        return $file;
    }

    public function removeQuot($path)
    {
        $string = 'This is a string &quot; &euro; &aacute; &amp;';
        $clean_path = preg_replace('#&[^;]+;#', '', $path);
        $pattern = '/&([#0-9A-Za-z]+);/';
        //        echo preg_replace($pattern, '', $path);
        return $clean_path;
    }

    public function checkDownloadStatus($cpl_id)
    {
        $result =  DB::table('ingests')
        ->where('cpl_id', $cpl_id)
        ->select('ingests.status')
        ->first();

        if ($result != null ) {
            return $result->status;
        } else {
            return 0;
        }

        /*$q = $this
            ->_db
            ->prepare('SELECT  status  FROM ingests WHERE  cpl_id  = ? ');
        try {
            $q->execute(array($cpl_id));
            $result = $q->fetch();
            if ($result !== false) {
                return $result['status'];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
    }

    public function checkSplIsDownloaded($uuid)
    {

        // check if object exists by id
        $q = $this->_db->prepare('SELECT COUNT(*) FROM spl_files WHERE file_size = file_progress AND uuid = :uuid');

        $q->bindParam(':uuid', $uuid);
        $q->execute();
        $res = $q->fetchColumn();
        if ($res > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function refreshLibrary($id_server, $server_ip, $usernameServer, $passwordServer, $remotePath)
    {
        // ******************* DCP
        $this->removeScannedFiles($id_server);
        $dcp_files = $this->scanLibraryDcpContent($id_server, $server_ip, $usernameServer, $passwordServer, $remotePath); //scan for dcp (cpl,pkl,asset,volIndex
        $this->saveScannedDcp($dcp_files, $usernameServer, $passwordServer, $server_ip, $id_server);
        // ******************** SPL
        /*$this->removeScannedSplFiles($id_server);
        $spl_files = $this->scanLibrarySplContent($id_server, $server_ip, $usernameServer, $passwordServer, $remotePath);
        $this->saveSplFiles($spl_files, $id_server, $server_ip, $usernameServer, $passwordServer); // save spl files,*/
    }

    public function removeScannedFiles($id_server)
    {
        /*$q2 = $this->_db->prepare('DELETE  FROM scanned_libraries   WHERE scanned_libraries.id_server = :id_server');

        try {
            $q2->execute(array(':id_server' => $id_server));
        } catch (PDOException $e) {
        }*/

        DB::table('scanned_libraries')->where('id_server', $id_server)->delete();

    }

    public function scanLibraryDcpContent($id_server, $server_ip, $server_username, $server_password, $remotePath)
    {
        $ftp_connection = $this->getConnection($server_ip, $server_username, $server_password);
        if ($ftp_connection != NULL) {
            ftp_pasv($ftp_connection, true);
            $result = $this->ftp_list_files_recursive($ftp_connection, $remotePath);
            $this->close($ftp_connection);

            return $result;
        } else {
            return "Can not Connect to server !";
        }
    }

    public function saveScannedDcp($files, $usernameServer, $passwordServer, $server_ip, $id_server)
    {


        foreach ($files as $file) {
            $check = 1;

            if ((substr($file, -12) == 'ASSETMAP.xml') or (substr($file, -8) == 'ASSETMAP')) { // asset map file

                $item_directory = dirname($file);

                $url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $this->removeQuot($file);
                // save asset file
                $asset_file = simplexml_load_string(file_get_contents(($this->removeQuot($url))));
                $asset_type = $this->checkAssetType($asset_file);

                if ($asset_type == "asset_type_multiple_pkl") {

                    $array_asset = json_decode(json_encode((array)$asset_file), TRUE);
                    $id_file = uniqid();
                    $asset_description = $asset_file->AnnotationText;
                    $asset_uuid = $asset_file->Id;
                    if ($this->checkFileExist($asset_uuid, $id_server) == 0) {
                        $type = "Assetmap";
                        $asset_uri = $this->removeQuot($file);
                        //  $this->saveScannedFiles($id_file, $asset_description, $asset_uuid, 0, 0, 0, 1, 0, $type, $asset_uri, $id_server);

                        $my_asset = $array_asset['AssetList']['Asset'];
                        $my_asset2 = $array_asset['AssetList']['Asset'];
                        foreach ($my_asset as $asset_item) {
                            if (pathinfo($asset_item['ChunkList']['Chunk']['Path'], PATHINFO_EXTENSION) == "xml") {
                                if (array_key_exists("PackingList", $asset_item)) {
                                    $pkl_file_name = $asset_item['ChunkList']['Chunk']['Path'];
                                    $pkl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($asset_item['ChunkList']['Chunk']['Path']);
                                    $pkl_uri = $item_directory . '/' . $this->removeQuot($asset_item['ChunkList']['Chunk']['Path']);
                                    try {
                                        $pkl_content = @file_get_contents($this->removeQuot($pkl_url));

                                    } catch (Exception $e) {
                                        echo 'Message: ' . $e->getMessage();
                                        continue;
                                    }
                                    if ($pkl_content === false) {
                                        $check = 0;
                                        continue;
                                    }

                                    $pkl_file = simplexml_load_string($pkl_content);
                                    if ($pkl_file !== false) {
                                        $id_pkl_file = uniqid();
                                        $uuid_pkl = $asset_item['Id'];
                                        if ($this->checkFileExist($uuid_pkl, $id_server) == 0) {
                                            $this->saveScannedFiles($id_pkl_file, $pkl_file->AnnotationText, $uuid_pkl, 0, 0, 0, 1, $asset_uuid, "PackagingList", $pkl_uri, $id_server);
                                            $this->updateFileAssetType($uuid_pkl, $id_server);
                                        }
                                        //get cpl id
                                        $targetAsset = null;

                                        //    $this->saveScannedFiles($id_file, $asset_description, $asset_uuid, 0, 0, 0, 1, 0, $type, $asset_uri, $id_server);

                                        foreach ($pkl_file->AssetList->Asset as $asset_pkl) {

                                            if ((string)$asset_pkl->Type === 'text/xml;asdcpKind=CPL' or (string)$asset_pkl->Type === 'text/xml') {
                                                $targetAsset = $asset_pkl;
                                                $cpl_uuid = (string)$targetAsset->Id;
                                                foreach ($my_asset2 as $asset_item2) {
                                                    if ($asset_item2['Id'] === $cpl_uuid) {
                                                        $chunk = $asset_item2['ChunkList']['Chunk'];
                                                        $path = $chunk['Path'];
                                                        $cpl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($path);
                                                    // $cpl_uri = $item_directory . '/' . $this->removeQuot($path);
                                                        $cpl_content_file = @file_get_contents(($this->removeQuot($cpl_url)));
                                                        if ($cpl_content_file === false) {
                                                            $cpl_file = simplexml_load_string($cpl_content_file);
                                                            if ($cpl_file !== false) {
                                                                if ($cpl_file->getName() === 'CompositionPlaylist') {
                                                                    $targetAsset = $asset_pkl;
                                                                    $cpl_uuid = (string)$targetAsset->Id;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }


                                            }
                                        }
                                        if ($targetAsset !== null) {
                                            $cpl_uuid = (string)$targetAsset->Id;
                                            foreach ($my_asset2 as $asset_item2) {
                                                if ($asset_item2['Id'] === $cpl_uuid) {
                                                    $chunk = $asset_item2['ChunkList']['Chunk'];
                                                    $path = $chunk['Path'];
                                                    $id_cpl_file = uniqid();
                                                    $cpl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($path);
                                                    $cpl_uri = $item_directory . '/' . $this->removeQuot($path);
                                                    $cpl_file = simplexml_load_string(file_get_contents(($this->removeQuot($cpl_url))));
                                                    if ($this->checkFileExist($cpl_uuid, $id_server) == 0) {
                                                        $repair = (json_decode(json_encode((array)$cpl_file->ReelList->Reel->AssetList), TRUE));
                                                            //                                    print_r($repair);
                                                            //                                // save cpl file
                                                        if (array_key_exists("MainPicture", $repair)) {
                                                            $is3d = "false";
                                                        } else {
                                                            $is3d = "True";
                                                        }
                                                        if (isset($id_pkl_file)) {
                                                            $this->saveScannedFiles($id_cpl_file, $cpl_file->ContentTitleText, $cpl_file->Id, $is3d, 0, 0, 1, $uuid_pkl, "CompositionPlaylist", $cpl_uri, $id_server);
                                                            $this->updateCPLID($cpl_uuid, $id_file);
                                                            $this->updateCPLID($cpl_uuid, $id_pkl_file);
                                                            $this->updateCPLID($cpl_uuid, $id_cpl_file);
                                                            $this->update3D($is3d, $cpl_uuid);
                                                            $this->updateFileAssetType($cpl_uuid, $id_server);
                                                        }
                                                    }
                                                }
                                            }
                                            $uuid_asset = $this->generateUuid();
                                            $asset_content = $this->generateAsset($pkl_file_name, $pkl_file, $uuid_asset, $my_asset2);

                                            $asset_content_with_declaration = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $asset_content;
                                            $dcp_dir = $this->createDcpDirectory($cpl_uuid);
                                            $new_asset = fopen($dcp_dir . "/ASSETMAP" . ".xml", "w") or die("Unable to open file!");
                                            fwrite($new_asset, $asset_content_with_declaration);

                                            fclose($new_asset);
                                            $id_file_asset = uniqid();
                                            $this->saveScannedFiles($id_file_asset, $pkl_file->AnnotationText, $uuid_asset, 0, 0, 0, 1, 0, "Assetmap", $dcp_dir . "/ASSETMAP" . ".xml", $id_server);
                                            $this->updateCPLID($cpl_uuid, $id_file_asset);
                                            $this->updateParentFile($uuid_asset, $pkl_file->Id, $cpl_uuid);
                                            $this->updateFileAssetType($uuid_asset, $id_server);
                                        } else {
                                            $this->removeFiles($asset_uuid, $id_server);
                                            $this->removeFiles($uuid_pkl, $id_server);
                                        }
                                    } else {
                                        $this->removeFiles($asset_uuid, $id_server);
                                    }
                                }
                            }
                        }
                    }

                } else {

                    $array_asset = json_decode(json_encode((array)$asset_file), TRUE);
                    $id_file = uniqid();
                    $asset_description = $asset_file->AnnotationText;
                    $asset_uuid = $asset_file->Id;
                    if ($this->checkFileExist($asset_uuid, $id_server) == 0) {
                        $type = "Assetmap";
                        $asset_uri = $this->removeQuot($file);
                        $this->saveScannedFiles($id_file, $asset_description, $asset_uuid, 0, 0, 0, 1, 0, $type, $asset_uri, $id_server);

                        $my_asset = $array_asset['AssetList']['Asset'];
                        $my_asset2 = $array_asset['AssetList']['Asset'];
                        foreach ($my_asset as $asset_item) {
                            if (pathinfo($asset_item['ChunkList']['Chunk']['Path'], PATHINFO_EXTENSION) == "xml") {
                                if (array_key_exists("PackingList", $asset_item)) {
                                    $pkl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($asset_item['ChunkList']['Chunk']['Path']);
                                    $pkl_uri = $item_directory . '/' . $this->removeQuot($asset_item['ChunkList']['Chunk']['Path']);
                                    try {
                                        $pkl_content = @file_get_contents($this->removeQuot($pkl_url));

                                    } catch (Exception $e) {
                                        echo 'Message: ' . $e->getMessage();
                                        continue;
                                    }
                                    if ($pkl_content === false) {
                                        $check = 0;
                                        continue;
                                    }

                                    $pkl_file = simplexml_load_string($pkl_content);
                                    if ($pkl_file !== false) {
                                        if ($this->countCPLAssets($pkl_file) == 1) {


                                            $id_pkl_file = uniqid();
                                            $uuid_pkl = $asset_item['Id'];
                                            if ($this->checkFileExist($uuid_pkl, $id_server) == 0) {

                                                $this->saveScannedFiles($id_pkl_file, $pkl_file->AnnotationText, $uuid_pkl, 0, 0, 0, 1, $asset_uuid, "PackagingList", $pkl_uri, $id_server);

                                            }
                                            //get cpl id
                                            $targetAsset = null;
                                            foreach ($pkl_file->AssetList->Asset as $asset_pkl) {

                                                if ((string)$asset_pkl->Type === 'text/xml;asdcpKind=CPL' or (string)$asset_pkl->Type === 'text/xml') {
                                                    $targetAsset = $asset_pkl;
                                                    $cpl_uuid = (string)$targetAsset->Id;
                                                    foreach ($my_asset2 as $asset_item2) {
                                                        if ($asset_item2['Id'] === $cpl_uuid) {
                                                            $chunk = $asset_item2['ChunkList']['Chunk'];
                                                            $path = $chunk['Path'];
                                                            $cpl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($path);
        //                                                    $cpl_uri = $item_directory . '/' . $this->removeQuot($path);
                                                            $cpl_content_file = @file_get_contents(($this->removeQuot($cpl_url)));
                                                            if ($cpl_content_file === false) {
                                                                $cpl_file = simplexml_load_string($cpl_content_file);
                                                                if ($cpl_file !== false) {
                                                                    if ($cpl_file->getName() === 'CompositionPlaylist') {
                                                                        $targetAsset = $asset_pkl;
                                                                        $cpl_uuid = (string)$targetAsset->Id;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }


                                                }
                                            }
                                            if ($targetAsset !== null) {
                                                $cpl_uuid = (string)$targetAsset->Id;
                                                foreach ($my_asset2 as $asset_item2) {
                                                    if ($asset_item2['Id'] === $cpl_uuid) {
                                                        $chunk = $asset_item2['ChunkList']['Chunk'];
                                                        $path = $chunk['Path'];
                                                        $id_cpl_file = uniqid();
                                                        $cpl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($path);
                                                        $cpl_uri = $item_directory . '/' . $this->removeQuot($path);
                                                        $cpl_file = simplexml_load_string(file_get_contents(($this->removeQuot($cpl_url))));
                                                        if ($this->checkFileExist($cpl_uuid, $id_server) == 0) {
                                                            $repair = (json_decode(json_encode((array)$cpl_file->ReelList->Reel->AssetList), TRUE));
        //                                    print_r($repair);
        //                                // save cpl file
                                                            if (array_key_exists("MainPicture", $repair)) {
                                                                $is3d = "false";
                                                            } else {
                                                                $is3d = "True";
                                                            }
                                                            if (isset($id_pkl_file)) {
                                                                $this->saveScannedFiles($id_cpl_file, $cpl_file->ContentTitleText, $cpl_file->Id, $is3d, 0, 0, 1, $uuid_pkl, "CompositionPlaylist", $cpl_uri, $id_server);
                                                                $this->updateCPLID($cpl_uuid, $id_file);
                                                                $this->updateCPLID($cpl_uuid, $id_pkl_file);
                                                                $this->updateCPLID($cpl_uuid, $id_cpl_file);
                                                                $this->update3D($is3d, $cpl_uuid);
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                $this->removeFiles($asset_uuid, $id_server);
                                                $this->removeFiles($uuid_pkl, $id_server);
                                            }
                                        } else {
                                            $Dcp_packs = $this->generateSeparatePKLFiles($pkl_file, $my_asset, $id_server, $usernameServer, $passwordServer, $server_ip, $item_directory);
                                            $this->removeFiles($asset_uuid, $id_server);
                                            foreach ($Dcp_packs as $pack) {

                                                $id_asset = uniqid();
                                                $id_pkl_file = uniqid();
                                                $id_cpl_file = uniqid();
                                                $tms_dcp_dir = $this->createDcpTmpDirectory($pack['cpl_uuid']);
                                                // generate aset .xml
                                                $new_asset = fopen($tms_dcp_dir . "/ASSETMAP" . ".xml", "w") or die("Unable to open file!");
                                                fwrite($new_asset, $pack['asset']);
                                                fclose($new_asset);
                                                // generate pkl .xml
                                                $new_pkl = fopen($tms_dcp_dir . "/" . $pack['pkl_uuid'] . ".xml", "w") or die("Unable to open file!");
                                                fwrite($new_pkl, $pack['pkl']);
                                                fclose($new_pkl);
                                                // generate cpl .xml
                                                $new_cpl = fopen($tms_dcp_dir . "/" . $pack['cpl_uuid'] . ".xml", "w") or die("Unable to open file!");
                                                fwrite($new_cpl, $pack['cpl']);
                                                fclose($new_cpl);
                                                $this->saveScannedFiles($id_asset, $pack['ContentTitleText'], $pack['asset_uuid'], 0, 0, 0, 1, 0, "Assetmap", $tms_dcp_dir . "/ASSETMAP" . ".xml", $id_server);
                                                $this->saveScannedFiles($id_pkl_file, $pack['ContentTitleText'], $pack['pkl_uuid'], 0, 0, 0, 1, $pack['asset_uuid'], "PackagingList", $tms_dcp_dir . "/" . $pack['pkl_uuid'] . ".xml", $id_server);
                                                $this->saveScannedFiles($id_cpl_file, $pack['ContentTitleText'], $pack['cpl_uuid'], false, 0, 0, 1, $pack['pkl_uuid'], "CompositionPlaylist", $tms_dcp_dir . "/" . $pack['cpl_uuid'] . ".xml", $id_server);
                                                $this->updateCPLID($pack['cpl_uuid'], $id_asset);
                                                $this->updateCPLID($pack['cpl_uuid'], $id_pkl_file);
                                                $this->updateCPLID($pack['cpl_uuid'], $id_cpl_file);
                                                $this->updateTypeParentDir(1, $item_directory, $pack['cpl_uuid']);
                                            }
                                        }

                                    } else {
                                        $this->removeFiles($asset_uuid, $id_server);
                                    }
                                }
                            }
                        }
                    }
                }

            }
        }
    }

    public function updateTypeParentDir($multiple_cpl, $source_dir, $cpl_id_pack)
    {

        DB::table('scanned_libraries')
        ->where('cpl_id_pack', $cpl_id_pack)
        ->update(array('multiple_cpl' => $multiple_cpl , 'source_dir' => $source_dir ));


       /* $q = $this
            ->_db->prepare('UPDATE scanned_libraries SET multiple_cpl = ?, source_dir = ?  WHERE cpl_id_pack = ?  ');
        $q->execute([$multiple_cpl, $source_dir, $cpl_id_pack]);*/
    }

    public function countCPLAssets($xml)
    {


        if ($xml === false) {
            // Failed to load XML
            return -1;
        }

        // Initialize the count
        $count = 0;

        // Loop through each Asset element within AssetList
        foreach ($xml->AssetList->Asset as $asset) {
            // Check if the Type is the specified value
            if ((string)$asset->Type === 'text/xml;asdcpKind=CPL') {
                // Increment the count
                $count++;
            }
        }

        return $count;
    }

    function generateSeparatePKLFiles($pkl, $my_asset_file, $id_server, $usernameServer, $passwordServer, $server_ip, $item_directory)
    {

        // Loop through each Asset element within AssetList
        $copy_pkl = $pkl;
        $copy_asset_file = $my_asset_file;
        $packs = array();
        $pkl_items = $pkl->AssetList->Asset;
        foreach ($pkl_items as $pkl_asset) {
            // Check if the Type is the specified value
            if ((string)$pkl_asset->Type === 'text/xml;asdcpKind=CPL') {
                foreach ($my_asset_file as $asset_item) {
                    if ($asset_item['Id'] == $pkl_asset->Id) {
                        $cpl_path = $asset_item['ChunkList']['Chunk']['Path'];

                        $cpl_url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $item_directory . '/' . $this->removeQuot($cpl_path);
                        $cpl_uri = $item_directory . '/' . $this->removeQuot($cpl_path);

                        try {
                            $cpl_content = @file_get_contents(($this->removeQuot($cpl_url)));
                            if ($cpl_content === false) {
                                $this->saveScanErrors("COULDN'T LOAD CPL PATH", "Function file_get_contents(), in function generateSeparatePKLFiles(), IngesterManager,  Failed to get contents from  path  ", $cpl_uri, $id_server, "Scan-DCP");

                            } else {
                                $cpl_file = simplexml_load_string(file_get_contents(($this->removeQuot($cpl_url))));
                                $assets = "";
                                $chunks = "";
                                $ContentTitleText = (string)$cpl_file->ContentTitleText;
                                foreach ($cpl_file->ReelList->Reel as $reel) {
                                    if (isset($reel->AssetList->MainPicture)) {
                                        $mainPictureId = (string)$reel->AssetList->MainPicture->Id;
                                        foreach ($copy_pkl->AssetList->Asset as $asset) {
                                            $assetId = (string)$asset->Id;
                                            $AnnotationText = (string)$asset->AnnotationText;
                                            $Hash = (string)$asset->Hash;
                                            $Size = (string)$asset->Size;
                                            $Type = (string)$asset->Type;
                                            if ($assetId === $mainPictureId) {
                                                if (isset($asset->OriginalFileName)) {
                                                    $OriginalFileName = $asset->OriginalFileName;
                                                    $assets = $assets . '<Asset>
                                                     <Id>' . $mainPictureId . '</Id>
                                                     <AnnotationText>' . $AnnotationText . '</AnnotationText>
                                                     <Hash>' . $Hash . '</Hash>
                                                     <Size>' . $Size . '</Size>
                                                     <Type>' . $Type . '</Type>
                                                     <OriginalFileName>' . $OriginalFileName . '</OriginalFileName>
                                                 </Asset>';
                                                    $chunks = $chunks .
                                                        ' <Asset>
                                                        <Id>' . $mainPictureId . '</Id>
                                                        <ChunkList>
                                                           <Chunk>
                                                             <Path>' . $OriginalFileName . '</Path>
                                                             <VolumeIndex>1</VolumeIndex>
                                                           </Chunk>
                                                       </ChunkList>
                                                     </Asset>';

                                                } else {
                                                    foreach ($copy_asset_file as $item) {
                                                        $Path = (string)$item['ChunkList']['Chunk']['Path'];

                                                        if ($item['Id'] == $mainPictureId) {
                                                            $assets = $assets . '<Asset>
                                                     <Id>' . $mainPictureId . '</Id>
                                                     <AnnotationText>' . $AnnotationText . '</AnnotationText>
                                                     <Hash>' . $Hash . '</Hash>
                                                     <Size>' . $Size . '</Size>
                                                     <Type>' . $Type . '</Type>
                                                     <OriginalFileName>' . $Path . '</OriginalFileName>
                                                 </Asset>';
                                                            $chunks = $chunks .
                                                                ' <Asset>
                                                        <Id>' . $mainPictureId . '</Id>
                                                        <ChunkList>
                                                           <Chunk>
                                                             <Path>' . $Path . '</Path>
                                                             <VolumeIndex>1</VolumeIndex>
                                                           </Chunk>
                                                       </ChunkList>
                                                     </Asset>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if (isset($reel->AssetList->MainSound)) {
                                        $mainSoundId = (string)$reel->AssetList->MainSound->Id;
                                        foreach ($copy_pkl->AssetList->Asset as $asset) {
                                            $assetId = (string)$asset->Id;
                                            $AnnotationText = (string)$asset->AnnotationText;
                                            $Hash = (string)$asset->Hash;
                                            $Size = (string)$asset->Size;
                                            $Type = (string)$asset->Type;

                                            if ($assetId === $mainSoundId) {
                                                if (isset($asset->OriginalFileName)) {
                                                    $OriginalFileName = $asset->OriginalFileName;
                                                    $assets = $assets . '<Asset>
                                                     <Id>' . $mainSoundId . '</Id>
                                                     <AnnotationText>' . $AnnotationText . '</AnnotationText>
                                                     <Hash>' . $Hash . '</Hash>
                                                     <Size>' . $Size . '</Size>
                                                     <Type>' . $Type . '</Type>
                                                     <OriginalFileName>' . $OriginalFileName . '</OriginalFileName>
                                                 </Asset>';
                                                    $chunks = $chunks .
                                                        ' <Asset>
                                                        <Id>' . $mainSoundId . '</Id>
                                                        <ChunkList>
                                                           <Chunk>
                                                             <Path>' . $OriginalFileName . '</Path>
                                                             <VolumeIndex>1</VolumeIndex>
                                                           </Chunk>
                                                       </ChunkList>
                                                     </Asset>';
                                                } else {
                                                    foreach ($copy_asset_file as $item) {
                                                        if ($item['Id'] == $mainSoundId) {
                                                            $Path = (string)$item['ChunkList']['Chunk']['Path'];
                                                            $assets = $assets . '<Asset>
                                                     <Id>' . $mainSoundId . '</Id>
                                                     <AnnotationText>' . $AnnotationText . '</AnnotationText>
                                                     <Hash>' . $Hash . '</Hash>
                                                     <Size>' . $Size . '</Size>
                                                     <Type>' . $Type . '</Type>
                                                     <OriginalFileName>' . $Path . '</OriginalFileName>
                                                 </Asset>';
                                                            $chunks = $chunks .
                                                                ' <Asset>
                                                        <Id>' . $mainSoundId . '</Id>
                                                        <ChunkList>
                                                           <Chunk>
                                                             <Path>' . $Path . '</Path>
                                                             <VolumeIndex>1</VolumeIndex>
                                                           </Chunk>
                                                       </ChunkList>
                                                     </Asset>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $generated_pkl_uuid = $this->generateUuid();
                                $generated_asset_uuid = $this->generateUuid();

                                $pkl_content = '<?xml version="1.0" encoding="UTF-8"?>
                                         <PackingList xmlns="http://www.digicine.com/PROTO-ASDCP-PKL-20040311#">
                     <Id>' . $generated_pkl_uuid . '</Id>
                     <AnnotationText>' . $ContentTitleText . '</AnnotationText>
                     <IssueDate>2023-11-15T09:32:58+00:00</IssueDate>
                     <Issuer>TMS</Issuer>
                     <Creator>TMS</Creator>
                     <AssetList>' . $assets .
                                    ' <Asset>
                         <Id>' . $pkl_asset->Id . '</Id>
                         <AnnotationText>' . $pkl_asset->AnnotationText . ' </AnnotationText>
                         <Hash>' . $pkl_asset->Hash . '/Rmxc=</Hash>
                         <Size>' . $pkl_asset->Size . '</Size>
                         <Type>text/xml;asdcpKind=CPL</Type>
                         <OriginalFileName>' . $cpl_path . '</OriginalFileName>
                       </Asset>
                     </AssetList>
                </PackingList>';

                                $asset_content = '<?xml version="1.0" encoding="UTF-8"?>
                                         <AssetMap xmlns="http://www.digicine.com/PROTO-ASDCP-AM-20040311#">
                            <Id>' . $generated_asset_uuid . '</Id>
                            <AnnotationText>' . $ContentTitleText . '</AnnotationText>
                            <VolumeCount>1</VolumeCount>
                            <IssueDate>2023-11-15T09:32:58+00:00</IssueDate>
                            <Issuer>TMS</Issuer>
                            <Creator>TMS</Creator>
                            <AssetList>' .
                                    $chunks .
                                    ' <Asset>
                                 <Id>' . $pkl_asset->Id . '</Id>
                                  <ChunkList>
                                    <Chunk>
                                      <Path>' . $cpl_path . '</Path>
                                      <VolumeIndex>1</VolumeIndex>
                                    </Chunk>
                                  </ChunkList>
                              </Asset>
                              <Asset>
                                 <Id>' . $generated_pkl_uuid . '</Id>
                                 <PackingList/>
                                 <ChunkList>
                                      <Chunk>
                                           <Path>PKL.xml</Path>
                                           <VolumeIndex>1</VolumeIndex>
                                       </Chunk>
                                 </ChunkList>
                              </Asset>
                            </AssetList>
                          </AssetMap>';
                                $dcp_item = array(
                                    "ContentTitleText" => $ContentTitleText,
                                    "asset_uuid" => $generated_asset_uuid,
                                    "asset" => $asset_content,
                                    "pkl_uuid" => $generated_pkl_uuid,
                                    "pkl" => $pkl_content,
                                    "cpl_uuid" => $asset_item['Id'],
                                    "cpl" => $cpl_content);

                                array_push($packs, $dcp_item);
                            }

                        } catch (Exception $e) {

                            $this->saveScanErrors("COULDN'T LOAD CPL PATH", $e->getMessage(), $cpl_uri, $id_server, "Scan-DCP");

                        }


                    }
                }
            }
        }

        return $packs;

    }

    public function checkAssetType($xml)
    {
        $assetElements = $xml->AssetList->Asset;

        // Check the count of PackingList elements within Asset elements
        $countPackingList = 0;
        foreach ($assetElements as $index => $assetElement) {
            $packingListElement = $assetElement->PackingList;

        //            echo "Asset #$index - PackingList element:\n";
        //            echo $packingListElement->asXML() . "\n\n";

            if ($packingListElement->count() > 0) {
                $countPackingList++;
            }
        }

        // Determine the asset type based on the count
        if ($countPackingList > 1) {
            $assetType = 'asset_type_multiple_pkl';
        } else if ($countPackingList === 1) {
            $assetType = 'asset_type_one_pkl';
        } else {
            $assetType = 'asset_type_none';
        }

        // Output the result
        return $assetType;
    }

    public function checkIngestExist($cpl_id)
    {

        $res =  DB::table('ingests')
        ->where('cpl_id', $cpl_id)
        ->get();

        if (count($res) > 0) {
            return "exists";
        } else {
            // Handle query error
            return "no";
        }

        /*$query = "SELECT *     FROM ingests   WHERE cpl_id = :cpl_id";

        $stmt = $this->_db->prepare($query);
        $stmt->bindParam(':cpl_id', $cpl_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return "exists";
        } else {
            // Handle query error
            return "no";
        }*/
    }

    public function isDownloaded($cpl_uuid)
    {

        $result= DB::table('ingests')
        ->where('cpl_id', $cpl_uuid)
        ->select('ingests.status')
        ->get();
        if ($result->status == "Complete") {
            return 1;
        } else {
            return 0;
        }
        /*
        $q = $this->_db->prepare('SELECT   status FROM tms.ingests WHERE  cpl_id =:cpl_id   ;  ');
        $q->bindParam(':cpl_id', $cpl_uuid);
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);

        if ($result['status'] == "Complete") {
            return 1;
        } else {
            return 0;
        }*/
    }

    public function checkFileExist($uuid, $server_id)
    {


        $exist = DB::table('scanned_libraries')
        ->where('id', $uuid)
        ->where('id_server', $server_id)
        ->get();

        if(count($exist) > 0 )
        {
            return 1 ;
        }
        else
        {
            return 0 ;
        }

        /*
        $q = $this
            ->_db
            ->prepare('SELECT EXISTS(SELECT * FROM scanned_libraries WHERE id  = ? AND id_server= ? ) as exist');

        try {
            $q->execute(array($uuid, $server_id));
            $result = $q->fetch();
            return ($result['exist']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        */

    }

    public function saveScannedFiles($id_file, $description, $id, $is3D, $isAlreadyIngested, $isComplete, $level, $parent_id, $type, $uri, $id_server)
    {

        DB::table('scanned_libraries')->insert(
            [
                'id_file' => $id_file ,
                'description' => $description,
                'id' =>  $id,
                'is3D' => $is3D,
                'isAlreadyIngested' => $isAlreadyIngested,
                'isComplete' => $isComplete,
                'level' => $level,
                'parent_id' => $parent_id,
                'type' => $type,
                'uri' => $uri,
                'id_server' => $id_server,
            ]
        );

        /*$q = $this->_db->prepare("INSERT INTO scanned_libraries (id_file,description,id,is3D,isAlreadyIngested, isComplete,level,parent_id, type, uri,id_server  ) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        try {
            $q->execute([$id_file, $description, $id, $is3D, $isAlreadyIngested, $isComplete, $level, $parent_id, $type, $uri, $id_server]);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
    }

    public function updateCPLID($cpl_id_pack, $id_file)
    {

        DB::table('scanned_libraries')
        ->where('id_file', $id_file)
        ->update(array('cpl_id_pack' => $cpl_id_pack));

       /*$q = $this
            ->_db->prepare('UPDATE scanned_libraries SET cpl_id_pack = ?  WHERE id_file = ?  ');
        $q->execute([$cpl_id_pack, $id_file]);*/
    }

    public function update3D($d, $id_file)
    {
        DB::table('scanned_libraries')
        ->where('cpl_id_pack', $id_file)
        ->update(array('is3D' => $d));


        /*$q = $this
            ->_db->prepare('UPDATE scanned_libraries SET is3D = ?  WHERE cpl_id_pack = ?  ');
        $q->execute([$d, $id_file]);*/
    }

    public function updateParentFile($parent_id, $id, $cpl_id_pack)
    {
        DB::table('scanned_libraries')
        ->where('id', $id)
        ->where('cpl_id_pack', $cpl_id_pack)
        ->update(array('parent_id' => $parent_id));


        /*$q = $this
            ->_db->prepare('UPDATE scanned_libraries SET parent_id = ?  WHERE id = ? ANd cpl_id_pack=?  ');
        $q->execute([$parent_id, $id, $cpl_id_pack]);*/
    }

    public function updateFileAssetType($uuid, $id_source)
    {

        DB::table('scanned_libraries')
        ->where('id', $uuid)
        ->where('id_server', $id_source)
        ->update(array('multiple_asset' => 1));

        /*$q = $this->_db->prepare('UPDATE scanned_libraries SET  multiple_asset = ?   WHERE id = ? AND id_server = ? ');
        $q->execute([1, $uuid, $id_source]);*/
    }

    public function removeScannedSplFiles($id_server)
    {
        $q2 = $this->_db->prepare('DELETE  FROM spl_scan_result   WHERE spl_scan_result.id_server = :id_server');
        try {
            $q2->execute(array(':id_server' => $id_server));
        } catch (PDOException $e) {
        }
    }

    public function scanLibrarySplContent($id_server, $server_ip, $usernameServer, $passwordServer, $remotePath)
    {
        $list_files = array();

        $ftp_connection = $this->getConnection($server_ip, $usernameServer, $passwordServer);


        if ($this->isDefaultLocation($id_server) == 1) {
            $list_files = $this->ftp_list_files_recursive($ftp_connection, $remotePath);
        }
        $this->close($ftp_connection);

        return $list_files;

    }

    public function getScannedFiles($id_library)
    {

        return DB::table('scanned_libraries')
                        ->where('id_server', $id_library)
                        ->select('scanned_libraries.*' , 'scanned_libraries.cpl_id_pack AS cpl_id')
                        ->get();

        /*$q = $this
            ->_db
            ->prepare(" SELECT scanned_libraries.*  ,scanned_libraries.cpl_id_pack as cpl_id


                      FROM  scanned_libraries

                    WHERE  scanned_libraries.id_server = ? ;");
        try {
            $q->execute(array($id_library));
            return $q->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
    }

    public function checkDcpIsDownloaded($cpl_uuid)
    {


        $res = DB::table('ingests')
            ->where('status','Complete')
            ->where('cpl_id',$cpl_uuid)
            ->get();

        if(count($res)> 0 )
        {
            return 1;
        }
        else
        {
            return 0;
        }
        // check if object exists by id
        /*$q = $this->_db->prepare('SELECT COUNT(*) FROM ingests WHERE status = "Complete" AND cpl_id = :cpl_id');

        $q->bindParam(':cpl_id', $cpl_uuid);
        $q->execute();
        $res = $q->fetchColumn();

        if ($res > 0) {
            return 1;
        } else {
            return 0;
        }*/

    }

    public function saveSplFiles($spl_files, $id_server, $server_ip, $usernameServer, $passwordServer)
    {


        libxml_use_internal_errors(true);
        foreach ($spl_files as $spl_file) {

            if (pathinfo($spl_file, PATHINFO_EXTENSION) === 'xml') {

                $url = 'ftp://' . $usernameServer . ':' . $passwordServer . '@' . $server_ip . $this->removeQuot($spl_file);
                try {
                    $content = @file_get_contents($this->removeQuot($url));

                    if ($content !== false) {

                        try {

                            $spl_file_data = simplexml_load_string($content);

                            if ($spl_file_data !== false) {

                                if ($spl_file_data->getName() === 'ShowPlaylist') {


                                    $spl_data = $this->getSplFileData($spl_file_data);
                                    $id_spl = uniqid();

                                    if ($this->checkSplExist($spl_data['uuid'], $id_server)) {
                                        //$this->deleteSplDownloadByUuid($spl_data['uuid']);
                                        //  $this->deleteSplScan($spl_data['uuid']);
                                    } else {
                                        //$this->insertSpl($id_spl, $spl_data['uuid'], $spl_data['ShowTitleText'], $spl_data['AnnotationText'], $spl_data['IssueDate'], $spl_data['Creator'], $spl_file, $id_server, $spl_data['duration'], $id_server, 0);
                                        $this->saveSplScanResult($id_spl, $spl_data['uuid'], $spl_data['ShowTitleText'], $spl_data['AnnotationText'], $spl_data['IssueDate'], $spl_data['Creator'], $spl_file, $id_server, $spl_data['duration'], $id_server, 0);
                                    }
                                }
                            } else {
                                $errors = libxml_get_errors();
                                foreach ($errors as $error) {
                                    // Process each error or log them
                                    $error_content = "XML Error: " . $error->message . " at line " . $error->line;
                                    $this->saveScanErrors("CORRUPTED SPL FILE", $error_content, $spl_file, $id_server, "Scan-SPL");
                                }
                                libxml_clear_errors();
                                continue;
                            }
                        } catch (Exception $e) {

                            // Handle the exception
                            // echo "An error occurred while loading the XML: " . $e->getMessage();
                            continue;
                        }
                    } else {
                        $errors = libxml_get_errors(); // Retrieve any XML errors
                        // Handle the errors as per your requirements
                        foreach ($errors as $error) {
                            $error_content = "XML Error: " . $error->message . " at line " . $error->line;
                            $this->saveScanErrors("CORRUPTED SPL FILE", $error_content, $spl_file, $id_server, "Scan-SPL");
        //                         echo "XML Error: " . $error->message . " at line " . $error->line;
                        }
                        libxml_clear_errors();
                        continue;
                    }
                } catch (Exception $e) {
                    $this->saveScanErrors("CORRUPTED SPL FILE", $e->getMessage(), $spl_file, $id_server, "Scan-SPL");
                    // Handle the exception
                    // echo "An error occurred while loading the XML: " . $e->getMessage();
                    continue;
                }


            }
        }
        libxml_use_internal_errors(false); // Enable internal libxml error handling
    }

    public function checkSplExist($uuid, $server_id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT EXISTS(SELECT * FROM spl_scan_result WHERE uuid  = ? AND id_server= ? ) as exist');

        try {
            $q->execute(array($uuid, $server_id));
            $result = $q->fetch();
            return ($result['exist']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getSplScanByIdServer($id_server)
    {

        $q = $this
            ->_db
            ->prepare(' SELECT spl_scan_result.ShowTitleText AS description,spl_scan_result.uuid AS id,
                               spl_files.file_size,spl_files.file_progress,
                              "ShowPlaylist" AS type, spl_scan_result.path_file As uri
                   FROM tms.spl_scan_result
                        left JOIN spl_files  ON spl_scan_result.uuid = spl_files.uuid
                        WHERE spl_scan_result.id_server =?');
        try {
            $q->execute(array($id_server));
            $result = $q->fetchAll() ?: null;
            return ($result);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isMedia($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT  ( CASE   WHEN serverType="Ingest" AND usb_content="1" THEN 1   else 0   END )  AS exist
                       FROM  server where idserver =  ?');
        try {
            $q->execute(array($id));
            $r = $q->fetch();
            return $r['exist'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function saveSplScanResult($id_spl, $uuid, $ShowTitleText, $AnnotationText, $IssueDate,
                                      $Creator, $path, $server_name, $duration, $id_server, $id_local_server)
    {
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $this
            ->_db
            ->prepare('INSERT INTO
                                 spl_scan_result(id_spl_file,uuid, ShowTitleText, AnnotationText , IssueDate, Creator,path_file,  server_name,last_update, duration,id_server,id_local_server)
                                VALUES(:id_spl_file,:uuid, :ShowTitleText, :AnnotationText, :IssueDate , :Creator,:path_file, :server_name, :last_update, :duration, :id_server,:id_local_server)');

        $q->bindValue(':id_spl_file', $id_spl);
        $q->bindValue(':uuid', $uuid);
        $q->bindValue(':ShowTitleText', $ShowTitleText);
        $q->bindValue(':AnnotationText', $AnnotationText);
        $q->bindValue(':IssueDate', $IssueDate);
        $q->bindValue(':Creator', $Creator);
        $q->bindValue(':path_file', $path);
        $q->bindValue(':server_name', $server_name);
        $q->bindValue(':last_update', date('Y-m-d H:i:s'));
        $q->bindValue(':duration', $duration);
        $q->bindValue(':id_server', $id_server);
        $q->bindValue(':id_local_server', $id_local_server);
        try {
            $q->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function saveScanErrors($error, $content, $file_path, $id_server, $type)
    {
        $date_time = date("Y-m-d H:i:s");

        try {
            DB::table('ingest_scan_errors')->insert([
                'title' => $error,
                'content' => $content,
                'file_path' => $file_path,
                'date_time' => $date_time,
                'id_server' => $id_server,
                'type' => $type
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        /*$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $this
            ->_db
            ->prepare('INSERT INTO
                                 ingest_scan_errors(title,content, file_path, date_time , id_server, type )
                                VALUES(:title,:content, :file_path, :date_time, :id_server, :type)');

        $q->bindValue(':title', $error);
        $q->bindValue(':content', $content);
        $q->bindValue(':file_path', $file_path);
        $q->bindValue(':date_time', $date_time);
        $q->bindValue(':id_server', $id_server);
        $q->bindValue(':type', $type);
        try {
            $q->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
    }



    public function checkSplExistByUuid($uuid)
    {
        $q = $this
            ->_db
            ->prepare('SELECT EXISTS(SELECT * FROM spl_files WHERE uuid  = ?   ) as exist');

        try {
            $q->execute(array($uuid));
            $result = $q->fetch();
            return ($result['exist']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getSplFileData($spl_file_data)
    {
        $spl_data_array = array();


        $spl_data_array ["uuid"] = (string)$spl_file_data->Id;
        $spl_data_array ["ShowTitleText"] = (string)$spl_file_data->ShowTitleText;
        $spl_data_array ["AnnotationText"] = (string)$spl_file_data->AnnotationText;
        $spl_data_array ["IssueDate"] = (string)$spl_file_data->IssueDate;
        $spl_data_array ["Creator"] = (string)$spl_file_data->Creator;

        $spl_data_array ["duration"] = $this->calculateSplDuration($spl_file_data);

        return $spl_data_array;
    }

    public function calculateSplDuration($simpleXml)
    {

        // print_r($simpleXml);
        $totalDuration = 0;

        // Iterate over the <Pack> elements
        if (property_exists($simpleXml, 'EventList')) {
            foreach ($simpleXml->EventList->Event as $event) {
                // Check if the <ElementList> exists within the <Event>
                if (isset($event->ElementList)) {
                    // Iterate over the <MainElement> elements within the <ElementList>
                    foreach ($event->ElementList->MainElement as $mainElement) {
                        // Check if the <Pattern> exists within the <MainElement>
                        if (isset($mainElement->Pattern)) {
                            // Extract the EditRate numerator and denominator
                            $editRateParts = explode(' ', (string)$mainElement->Pattern->EditRate);
                            $editRateNumerator = (int)$editRateParts[0];
                            $editRateDenominator = (int)$editRateParts[1];

                            // Calculate and accumulate the duration based on EditRate
                            $duration = (int)$mainElement->Pattern->Duration;
                            $totalDuration += $duration * $editRateDenominator / $editRateNumerator;
                        } elseif (isset($mainElement->Composition)) {
                            // Check if the <EditRate> exists within the <Composition>
                            if (isset($mainElement->Composition->EditRate)) {
                                // Extract the EditRate numerator and denominator
                                $editRateParts = explode(' ', (string)$mainElement->Composition->EditRate);
                                $editRateNumerator = (int)$editRateParts[0];
                                $editRateDenominator = (int)$editRateParts[1];

                                // Check if the <Duration> tag exists within the <Composition>
                                if (isset($mainElement->Composition->Duration)) {
                                    // Calculate and accumulate the duration based on EditRate
                                    $duration = (int)$mainElement->Composition->Duration;
                                    $totalDuration += $duration * $editRateDenominator / $editRateNumerator;
                                } elseif (isset($mainElement->Composition->IntrinsicDuration)) {
                                    // Calculate and accumulate the duration based on EditRate
                                    $intrinsicDuration = (int)$mainElement->Composition->IntrinsicDuration;
                                    $totalDuration += $intrinsicDuration * $editRateDenominator / $editRateNumerator;
                                }
                            }
                        }
                    }
                }
            }

        } elseif (property_exists($simpleXml, 'PackList')) {
            foreach ($simpleXml->PackList->Pack as $pack) {
                // Check if the <EventList> exists within the <Pack>
                if (isset($pack->EventList)) {
                    // Iterate over the <Event> elements within the <EventList>
                    foreach ($pack->EventList->Event as $event) {
                        // Check if the <ElementList> exists within the <Event>
                        if (isset($event->ElementList)) {
                            // Iterate over the <MainElement> elements within the <ElementList>
                            foreach ($event->ElementList->MainElement as $mainElement) {
                                // Check if the <Pattern> exists within the <MainElement>
                                if (isset($mainElement->Pattern)) {
                                    // Extract the EditRate numerator and denominator
                                    $editRateParts = explode(' ', (string)$mainElement->Pattern->EditRate);
                                    $editRateNumerator = (int)$editRateParts[0];
                                    $editRateDenominator = (int)$editRateParts[1];

                                    // Calculate and accumulate the duration based on EditRate
                                    $duration = (int)$mainElement->Pattern->Duration;
                                    $totalDuration += $duration * $editRateDenominator / $editRateNumerator;
                                } elseif (isset($mainElement->Composition)) {
                                    // Check if the <EditRate> exists within the <Composition>
                                    if (isset($mainElement->Composition->EditRate)) {
                                        // Extract the EditRate numerator and denominator
                                        $editRateParts = explode(' ', (string)$mainElement->Composition->EditRate);
                                        $editRateNumerator = (int)$editRateParts[0];
                                        $editRateDenominator = (int)$editRateParts[1];

                                        // Check if the <Duration> tag exists within the <Composition>
                                        if (isset($mainElement->Composition->Duration)) {
                                            // Calculate and accumulate the duration based on EditRate
                                            $duration = (int)$mainElement->Composition->Duration;
                                            $totalDuration += $duration * $editRateDenominator / $editRateNumerator;
                                        } elseif (isset($mainElement->Composition->IntrinsicDuration)) {
                                            // Calculate and accumulate the duration based on EditRate
                                            $intrinsicDuration = (int)$mainElement->Composition->IntrinsicDuration;
                                            $totalDuration += $intrinsicDuration * $editRateDenominator / $editRateNumerator;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        return $totalDuration;
    }

    public function isDefaultLocation($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT  ( CASE   WHEN serverType="Ingest" AND default_location="1" THEN 1   else 0   END )  AS exist
                       FROM  server where idserver =  ?');
        try {
            $q->execute(array($id));
            $r = $q->fetch();
            return $r['exist'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ftp_list_files_recursive($connection, $path, &$visitedDirs = array())
    {

        $files = ftp_nlist($connection, $path);


        $result = array();
        if (!empty($files)) {
            foreach ($files as $file) {
                $filename = basename($file);
                $isDirectory = ftp_size($connection, $file) === -1; // Check if it's a directory

                if ($isDirectory) {
                    // Check if the directory has already been visited to avoid infinite loop
                    if (!in_array($file, $visitedDirs)) {
                        $visitedDirs[] = $file;
                        $result = array_merge($result, $this->ftp_list_files_recursive($connection, $file, $visitedDirs));

                    }
                } else {
                    $result[] = $file;
                }
            }
        }

        return $result;
    }

    public function checkServerFtpConnection($id_server)
    {
        //$manager_server = new ServerManager(getdb());
        $server = Ingestsource::find($_POST["screen_id"]) ;
       // $server = $manager_server->getServerById2($id_server);
        $ftp_connection = $this->getConnection($server->server_ip, $server->usernameServer, $server->passwordServer);

        if ($ftp_connection == null) {
            return false;
        } else {
            return true;
        }
    }

    public function getSplDetailsScanByUuid($uuid, $id_server)
    {
        $stmt = $this->_db->prepare('select * from `spl_scan_result` WHERE uuid=:uuid AND id_server=:id_server');
        $stmt->execute(['uuid' => $uuid, 'id_server' => $id_server]);
        return $stmt->fetch();
    }

    public function insertSpl($id_spl, $uuid, $ShowTitleText, $AnnotationText, $IssueDate,
                              $Creator, $path, $server_name, $duration, $id_server, $id_local_server)
    {
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $this
            ->_db
            ->prepare('INSERT INTO
                                 spl_files(id_spl_file,uuid, ShowTitleText, AnnotationText , IssueDate, Creator,path_file,  server_name,last_update, duration,id_server,id_local_server)
                                VALUES(:id_spl_file,:uuid, :ShowTitleText, :AnnotationText, :IssueDate , :Creator,:path_file, :server_name, :last_update, :duration, :id_server,:id_local_server)');

        $q->bindValue(':id_spl_file', $id_spl);
        $q->bindValue(':uuid', $uuid);
        $q->bindValue(':ShowTitleText', $ShowTitleText);
        $q->bindValue(':AnnotationText', $AnnotationText);
        $q->bindValue(':IssueDate', $IssueDate);
        $q->bindValue(':Creator', $Creator);
        $q->bindValue(':path_file', $path);
        $q->bindValue(':server_name', $server_name);
        $q->bindValue(':last_update', date('Y-m-d H:i:s'));
        $q->bindValue(':duration', $duration);
        $q->bindValue(':id_server', $id_server);
        $q->bindValue(':id_local_server', $id_local_server);
        try {
            $q->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function downloadSplFiles($spl_scan_details, $uuid, $uri, $server_ip, $username, $password)
    {
        $tms_hard_drive = "/DATA";
        $tms_path = $tms_hard_drive . "/spl/" . $uuid . ".xml";
        //        $prefix = $prefix = "/DATA";
        //        if (substr($uri, 0, strlen($prefix)) == $prefix) {
        //            $uri = substr($uri, strlen($prefix));
        //        }
        $url = 'ftp://' . $username . ':' . $password . '@' . $server_ip . '/' . $uri;


        $file_size = $this->getFileSize($server_ip, $username, $password, $uri);

        $this->updateDataSpl($uuid, $tms_path, $file_size);
        //  print_r( ftp_raw($ftp_conn, "SIZE /" . $remote_file));
        $hout = fopen($tms_hard_drive . '/spl/' . $uuid . '.xml', "wb") or die("Cannot open destination file");
        $hin = fopen($url, "rb") or die("Cannot open source file");
        while (!feof($hin)) {
            $buf = fread($hin, 2024);
            fwrite($hout, $buf);
            $p = intval(ftell($hin));
            $this->updateProgressSpl($uuid, $p);
        }

        fclose($hin);
        fclose($hout);

    }

    public function updateProgressSpl($uuid, $progress)
    {
        $date_create_ingest = date('Y-m-d H:i:s');

        $q = $this
            ->_db->prepare('UPDATE spl_files SET  file_progress = ?,  last_update = ? WHERE uuid = ?  ');
        $q->execute([$progress, $date_create_ingest, $uuid]);
    }

    public function updateDataSpl($uuid, $tms_path, $size)
    {
        $q = $this->_db->prepare('UPDATE spl_files SET  file_size = ? ,tms_path=? WHERE uuid = ?  ');
        $q->execute([$size, $tms_path, $uuid]);
    }

    public function getFileSize($host, $user, $pass, $file_path)
    {

        $con = $this->getConnection($host, $user, $pass);
        $response = ftp_raw($con, "SIZE /" . $file_path);
        $this->close($con);
        return floatval(str_replace('213 ', '', $response[0]));
    }

    public function deleteLocalSplStorage($uuid)
    {
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $q1 = $this->_db->prepare('DELETE
        FROM spl_files
        WHERE spl_files.uuid  = :uuid  ');
        $q1->bindParam(':uuid', $uuid);
        if ($q1->execute()) {
            return 1;
        } else {
            return 0;
        }
    }




    // *********************************************************** script methods

    public function getListIngest()
    {


        $res =  DB::table('ingests')
            ->select('ingests.*', 'ingestsources.id', 'ingestsources.usernameServer', 'ingestsources.passwordServer', 'ingestsources.server_ip')
            ->leftJoin('ingestsources', 'ingests.id_source', '=', 'ingestsources.id')
            ->where('status', 'pending')
            ->where('status', 'Pending')
            ->orderBy('ingests.order', 'ASC')
            ->get();

        return $res ;



        /*$stmt = $this->_db->prepare('SELECT ingests.*,
                                            server.idserver,  server.usernameServer,  server.passwordServer,server.server_ip
                                        FROM   `ingests`
                                        LEFT JOIN server  ON ingests.id_source = server.idserver
                                        WHERE status = "pending" ORDER BY ingests.order ASC ');
        $stmt->execute();
        return $stmt->fetchAll(); */
    }
    public function getIngestFiles($cpl_uuid)
    {

        $res = DB::table('ingest_dcp_large')
            ->select('ingest_dcp_large.*', 'ingests.pkl_uri', 'ingests.id_source')
            ->leftJoin('ingests', 'ingest_dcp_large.id_cpl', '=', 'ingests.cpl_id')
            ->where('ingest_dcp_large.id_cpl', '=', $cpl_uuid)
            ->get();

        return $res ;

        /*$stmt = $this->_db->prepare('SELECT ingest_dcp_large.*  ,ingests.pkl_uri,ingests.id_source
                                          FROM   `ingest_dcp_large`
                                          LEFT JOIN ingests  ON ingest_dcp_large.id_cpl = ingests.cpl_id
                                          WHERE ingest_dcp_large.id_cpl=:id_cpl');
        $stmt->execute(['id_cpl' => $cpl_uuid]);
        return $stmt->fetchAll();*/
    }
    public function ingestHasMxf($idCpl) {

        $resultSet = DB::table('ingest_dcp_large')
            ->leftJoin('ingests', 'ingest_dcp_large.Id', '=', 'ingests.cpl_id')
            ->where('ingest_dcp_large.id_cpl', $idCpl)
            ->whereNull('ingests.cpl_id')
            ->count();

        if ($resultSet == 0) {
            // The result set is empty
            return 0;
        } else {
            return 1;
        }

        /*$stmt = $this->_db->prepare('
                                  SELECT COUNT(*) as nbr_mxf FROM
                                 ingest_dcp_large
                                 LEFT JOIN ingests ON ingest_dcp_large.Id = ingests.cpl_id
                                 WHERE ingest_dcp_large.id_cpl = :id_cpl
                                 AND ingests.cpl_id IS NULL ');
        $stmt->execute(['id_cpl' => $idCpl]);

        // Fetch the result
        $resultSet = $stmt->fetch();


        if ($resultSet['nbr_mxf']==  0) {
            // The result set is empty
            return 0;
        }
        else{
            return 1;
        }
        */
    }
    public function updateIngestHasMxf($uuid_cpl, $has_mxf_status)
    {

        DB::table('ingests')
            ->where('cpl_id', $uuid_cpl)
            ->update(['hasMxf' => $has_mxf_status]);


        /*$q = $this
            ->_db->prepare('UPDATE ingests SET hasMxf = ?  WHERE cpl_id = ?  ');
        $q->execute([$has_mxf_status, $uuid_cpl]);*/
    }

    public function updateIngestStartDownloadByCplUuid($uuid_cpl, $date_start_ingesting)
    {

        DB::table('ingests')
            ->where('cpl_id', $uuid_cpl)
            ->update(['date_start_ingesting' => $date_start_ingesting]);

        /*$q = $this
            ->_db->prepare('UPDATE ingests SET date_start_ingesting = ?  WHERE cpl_id = ?  ');
        $q->execute([$date_start_ingesting, $uuid_cpl]);*/
    }

    public function checkRunningExist()
    {

        $RunningExists = false; // Initialize the variable
        try {
            $status = 'running';
            $count = DB::table('ingests')->where('status', $status)->count();

            if ($count > 0) {
                return 1; // Task exists
            } else {
                return 0; // Task does not exist
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        /*
        $RunningExists = false; // Initialize the variable
        $q = $this
            ->_db
            ->prepare('SELECT  COUNT(*)    FROM ingests WHERE  status = :status   ');
        try {
            $status = "running";
            $q->bindParam(':status', $status);
            $q->execute();
            $count = $q->fetchColumn();
            if ($count > 0) {
                $RunningExists = true;
            }
            if ($RunningExists) {
                return 1; // Task exists
            } else {
                return 0; // Task does not exist
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        */

    }

     public function startDownloadPackIngest($mxf_pack, $cpl_uuid, $server_ip, $usernameServer, $passwordServer)
    {
        echo "=============================================" . PHP_EOL;
        echo " download pack , cpl uuid : " . $cpl_uuid . PHP_EOL;
        echo "  time start  : " . date('Y-m-d H:i:s') . PHP_EOL;
        $i = 0;
        $check_status = "Complete";
        foreach ($mxf_pack as $mxf) {
            $download_status = $this->checkDownloadStatus($cpl_uuid);
            if ($download_status == "running") {
                // if ($this->checkFileDownloadedIdMxfIdCPl($mxf['id_file'],$cpl_uuid) == 0) {
                // if ($this->checkFileDownloaded($mxf['id_file']) == 0) {

                if ($this->checkFileDownloadedByIdAndCPl($mxf->id_file, $cpl_uuid) == 0) {
                    $check = $this->downloadLargeIngest($mxf->id_file, $cpl_uuid, $server_ip, $usernameServer, $passwordServer, $mxf->pkl_uri, $mxf->tms_dir, $mxf->OriginalFileName, $mxf->Size, $i);
                    if ($check == "Failed") {
                        $this->updateIngestStatusByCplUuid($mxf->id_cpl, "Failed");
                        $check_status = "Failed";
                        break;
                    }
                    if ($check == "pending") {
                        $this->updateIngestStatusByCplUuid($mxf->id_cpl, "pending");
                        $check_status = "pending";
                        break;
                    }
                    if ($check == "Paused") {
                        $this->updateIngestStatusByCplUuid($mxf->id_cpl, "Paused");
                        $check_status = "Paused";
                        break;
                    }
                }
                $i++;
            } else {
                break;
            }
        }
        $this->updateIngestStatusByCplUuid($cpl_uuid, $check_status);
        if ($this->check_DcpIsDownloaded($cpl_uuid) == 1) {

            $this->updateIngestCplData($cpl_uuid);
        } else {

        }
    }

    public function updateIngestCplData($cpl_uuid)
    {

        //$playlist_builder_manager = new  PlaylistBuilderManager(getdb());
        $data_dcp = $this->getDcpData($cpl_uuid);

$data_dcp = json_decode(json_encode($data_dcp), true);
        $fileInfo = $this->getMediaInfo2(escapeshellarg($data_dcp['tms_dir'] . '/' . basename($data_dcp['cpl_uri'])));
        $media_info_xml = simplexml_load_string($fileInfo);
        $VideoTrack = $media_info_xml->media->track[1];
        //        $Width = (string)$VideoTrack->Width;
        //        $Height = (string)$VideoTrack->Height;
        //        $DisplayAspectRatio = (string)$VideoTrack->DisplayAspectRatio;
        $cpl_file = simplexml_load_string(file_get_contents($data_dcp['tms_dir'] . "/" . basename($data_dcp['cpl_uri'])));
        $array_cpl = json_decode(json_encode((array)$cpl_file), TRUE);
        if (isset($VideoTrack->Width) && isset($VideoTrack->Height)) {
            $Width = (string)$VideoTrack->Width;
            $Height = (string)$VideoTrack->Height;
            $DisplayAspectRatio = (string)$VideoTrack->DisplayAspectRatio;

        } else {
            $namespaces = $cpl_file->getNamespaces(true);
            $namespace = isset($namespaces['msp-cpl']) ? $namespaces['msp-cpl'] : null;
            // Check if the namespace exists and register it
            if ($namespace) {
                $cpl_file->registerXPathNamespace('msp', $namespace);
            }
            $reels = $cpl_file->ReelList->Reel;
            foreach ($reels as $reel) {
                $reelDuration = 0;
                // Check if MainStereoscopicPicture exists and calculate the duration
                if ($namespace) {
                    $mainStereoscopicPicture = $cpl_file->xpath('//msp:MainStereoscopicPicture');
                } else {
                    $mainStereoscopicPicture = null;
                }

                if ($mainStereoscopicPicture && isset($mainStereoscopicPicture[0]->ScreenAspectRatio)) {
                    $screenAspectRatio = $mainStereoscopicPicture[0]->ScreenAspectRatio;
                }
                else {
                    // Check if MainPicture exists and calculate the duration
                    $mainPicture = $reel->AssetList->MainPicture;

                    if ($mainPicture) {
                        $screenAspectRatioElement = $mainPicture->ScreenAspectRatio;

                        if ($screenAspectRatioElement) {
                            // Check if the ScreenAspectRatio has the "scope" attribute
                            if ($screenAspectRatioElement->attributes() && isset($screenAspectRatioElement->attributes()['scope'])) {
                                $scopeAttribute = (string)$screenAspectRatioElement->attributes()['scope'];
                                if ($scopeAttribute === "http://www.digicine.com/PROTO-ASDCP-CPL-20040511#standard-aspectratio") {
                                    $screenAspectRatio = (string)$screenAspectRatioElement;
                                } else {
                                    // Handle different scope attribute value
                                    // For example, you can skip this or set a default value
                                    $screenAspectRatio = "unknown";
                                }
                            } else {
                                $screenAspectRatio = (string)$screenAspectRatioElement;
                            }

                        }
                    }
                }

                if ($screenAspectRatio !== null) {
                    if (strpos($screenAspectRatio, ' ') !== false) {
                        list($Width, $Height) = explode(' ', $screenAspectRatio);

                        $DisplayAspectRatio = $roundedAspectRatio = round(intval($Width) / intval($Height), 3);
                    } else {
                        $Width = 0;
                        $Height = 0;
                        $DisplayAspectRatio = $screenAspectRatio;
                    }
                    // Break out of the inner loop after checking one reel
                    break;
                }
            }
        }

        //get sound channels
        if (isset($media_info_xml->media->track[2])) {
            $audioTrack = $media_info_xml->media->track[2];
            $channels = (int)$audioTrack->Channels;
        } else {
            $channels = 0;
        }
        $FrameRate = (string)$VideoTrack->FrameRate;
        $FrameRate_String = (string)$VideoTrack->FrameRate_String;
        $FrameCount = (string)$VideoTrack->FrameCount;

        $edit_rate_duration = $this->getCplDuration3($cpl_file);

        $edit_rate = $this->getEditRate2($cpl_file);
        if (intval($edit_rate['editRate_numerator']) != 0) {
            $durationFormatted = round(intval($edit_rate_duration) * intval($edit_rate['editRate_denominator']) / intval($edit_rate['editRate_numerator']));
        } else {
            $durationFormatted = 0;
        }

        $this->updateCplData((string)$cpl_file->Creator,
            (string)$edit_rate['edit_rate'], $edit_rate['editRate_numerator'], $edit_rate['editRate_denominator'],
            $FrameRate, $FrameRate_String, $FrameCount,
            $edit_rate_duration, $durationFormatted, $this->secondsToHms($durationFormatted),
            $channels,
            $DisplayAspectRatio, $Width, $Height, $cpl_uuid);
        $this->updateCplNeedKdm($cpl_uuid, $this->checkLocalCplNeedsKdm($array_cpl['ReelList']));

    }
    public function getMediaInfo2($cpl_path)
    {
        echo "<br/>";
        //$command = 'mediainfo --output=EBUCore ' . $cpl_path . " -f";
        $command = 'mediainfo --output=XML   ' . $cpl_path . " -f";
        // echo$command;echo"<br/>";
        $output = shell_exec($command);
        return $output;
    }

    public function getDcpData($cpl_id)
    {
        try {
            $result = DB::table('ingests')
                ->select('ingests.id', 'ingests.cpl_id', 'ingests.cpl_description', 'ingests.id_source', 'ingests.tms_dir',
                'ingests.cpl_uri',  'ingestsources.serverName AS name_source')
                 ->selectRaw('"Ingest" AS serverType')
                ->leftJoin('ingestsources', 'ingests.id_source', '=', 'ingestsources.id')
                ->where('status', 'Complete')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('ingest_dcp_large as l')
                        ->whereColumn('l.id_cpl', 'ingests.cpl_id')
                        ->where('l.hash_verified', 0);
                })
                ->where('ingests.cpl_id', $cpl_id)
                ->first();

            return $result;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        /*
        $q = $this
            ->_db
            ->prepare('SELECT ingests.id,ingests.cpl_id, ingests.cpl_description,
                              ingests.id_source,ingests.tms_dir,ingests.cpl_uri,
                              server.serverType ,server.serverName AS name_source
                       FROM  ingests
                       left JOIN server   ON ingests.id_source = server.idserver
                       WHERE status  ="Complete"
                       AND NOT EXISTS ( SELECT 1  FROM ingest_dcp_large l   WHERE l.id_cpl = ingests.cpl_id  AND l.hash_verified = 0 )
                       AND ingests.cpl_id = :cpl_id ');
        try {
            $q->bindValue(':cpl_id', $cpl_id, PDO::PARAM_STR);
            $q->execute();

            return $q->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
    }
    public function check_DcpIsDownloaded($cpl_id)
    {


        try {
            $result = DB::table('ingests')
                ->select(DB::raw('COUNT(*) AS result'))
                ->where('cpl_id', $cpl_id)
                ->where('status', 'Complete')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                          ->from('ingest_dcp_large as l')
                          ->whereColumn('l.id_cpl', 'ingests.cpl_id')
                          ->where('l.hash_verified', 0);
                })
                ->first();

            if ($result && $result->result > 0) {
                return 1;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        /*$q = $this->_db->prepare('  SELECT COUNT(*) AS result  FROM ingests
                                    WHERE cpl_id = :cpl_id  AND status = "Complete"
                                   AND NOT EXISTS ( SELECT 1 FROM ingest_dcp_large l  WHERE l.id_cpl = ingests.cpl_id AND l.hash_verified = 0
                                                  )
                               ');

        $q->bindValue(':cpl_id', $cpl_id, PDO::PARAM_STR);
        $q->execute();
        $row = $q->fetch(PDO::FETCH_ASSOC);
        if ($row['result'] > 0) {
            return 1;
        } else {
            return 0;
        }*/
    }
    public function checkFileDownloadedByIdAndCPl($id_file, $cpl_id)
    {
        try {
            $result = DB::table('ingest_dcp_large')
                ->select('status', 'hash_verified')
                ->where('id_file', $id_file)
                ->where('id_cpl', $cpl_id)
                ->first();

            if ($result && $result->status === 'Complete' && $result->hash_verified == 1) {
                return 1;
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        /*$q = $this
            ->_db
            ->prepare('SELECT  status,hash_verified  FROM ingest_dcp_large WHERE  id_file  = ? AND id_cpl=? ');
        try {
            $q->execute(array($id_file, $cpl_id));
            $result = $q->fetch(PDO::FETCH_ASSOC);
            if ($result and $result['status'] == "Complete" and $result['hash_verified'] == 1) {
                return 1;
            } else {
                return 0;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/

    }

    public function downloadLargeIngest($id_file, $cpl_id, $ftpServer, $ftpUsername, $ftpPassword, $pkl_uri, $tms_dir, $OriginalFileName, $file_size, $current_pack)
    {
        echo " download mxf  , cpl uuid : " . $cpl_id . "mxf id : " . $id_file . PHP_EOL;
        $localFilePath = $this->prepareLocalPath($OriginalFileName, $tms_dir);

        $uri = $this->prepareRemotePathUri($pkl_uri);
        $remoteFilePath = $this->getDirectory($uri) . '/' . $OriginalFileName;
        chmod($tms_dir, 0777);
        // Connect to FTP server
        $ftpConnection = $this->getConnection($ftpServer, $ftpUsername, $ftpPassword);
        if (!$ftpConnection) {
            echo("Failed to login to FTP server");
            $status = "Failed";
            return "Failed";
        }

        // Login to FTP server

        //        $ftpLogin = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
        //        if (!$ftpLogin) {
        //            echo("Failed to login to FTP server");
        //            return "Failed";
        //        }

        // Enable passive mode
        ftp_pasv($ftpConnection, true);

        // Set transfer mode to binary
        ftp_set_option($ftpConnection, FTP_BINARY, true);

        // Open local file for writing
        $localFile = fopen($localFilePath, 'wb');
        if (!$localFile) {
            // $this->updateMxfFileStatus("Failed", $id_file);
            $this->updateMxfFileStatusByIdAndCPlId("Failed", $id_file, $cpl_id);

            $this->updateIngestStatusByCplUuid($cpl_id, "Failed");
            echo "Failed to open local file for writing" . PHP_EOL;
            $status = "Failed";
            return "Failed";

        }
        ftp_set_option($ftpConnection, FTP_BINARY, true);
        //$chunkSize = 100;


        //  $chunkSize = 1024 * 1024; // Set chunk size to 1 MB


        set_error_handler([$this, 'customErrorHandler']);
        if (!ftp_nb_fget($ftpConnection, $localFile, $remoteFilePath, FTP_BINARY)) {
            // $this->updateMxfFileStatus("Failed", $id_file);
            $this->updateMxfFileStatusByIdAndCPlId("Failed", $id_file, $cpl_id);
            $this->updateIngestStatusByCplUuid($cpl_id, "Failed");
            fclose($localFile);
            ftp_close($ftpConnection);
            $status = "Failed";
            echo "Failed to execute ftp_nb_fget  " . PHP_EOL;
            return "Failed";
        }
        restore_error_handler();
        $counter = 0;
        while (true) {
            $errorCode = ftp_nb_continue($ftpConnection);
            if ($errorCode === FTP_FINISHED) {
                break;
            } elseif ($errorCode === FTP_FAILED) {
                //$this->updateMxfFileStatus("Failed", $id_file);
                $this->updateMxfFileStatusByIdAndCPlId("Failed", $id_file, $cpl_id);
                echo "Failed to execute ftp_nb_continue  " . PHP_EOL;
                $status = "Failed";
                break;
            } elseif ($errorCode === FTP_MOREDATA) {
                $counter++;
                if ($counter % 40 === 0) {
                    $bytesRead = ftell($localFile);
                    // $this->updateProgressLargeFile($id_file, $bytesRead);
                    $this->updateProgressLargeFileByIdAndCplId($id_file, $bytesRead, $cpl_id);

                    $status = $this->checkDownloadStatus($cpl_id);
                    if ($status != "running") {
                        break;
                    }
                }
            } else {
                $status = "Failed";
                //$this->updateMxfFileStatus("Failed", $id_file);
                echo "Failed to execute ftp_nb_continue  " . PHP_EOL;
                $this->updateMxfFileStatusByIdAndCPlId("Failed", $id_file, $cpl_id);
                break;
            }
        }
        $bytesRead = ftell($localFile);
        $this->updateProgressLargeFileByIdAndCplId($id_file, $bytesRead, $cpl_id);
        if ($bytesRead == $file_size) {
            if ($this->hashFile($localFilePath) == $this->getHashMxf($id_file)) {
                $this->updateHashStatus(1, $id_file);
            } else {
                $this->updateHashStatus(0, $id_file);
            }
            $this->updateMxfFileStatus("Complete", $id_file);
            if ($this->countPackMxfFiles($cpl_id) == $current_pack + 1) {
                $this->updateIngestStatusByCplUuid($cpl_id, "Complete");
            }
            fclose($localFile);
            ftp_close($ftpConnection);
            return 1;
        } else {
            fclose($localFile);
            ftp_close($ftpConnection);
            if (!isset($status)) {
                $status = 'Failed';
            }
            //$this->updateMxfFileStatus($status, $id_file);
            $this->updateMxfFileStatusByIdAndCPlId($status, $id_file, $cpl_id);
            $this->updateIngestStatusByCplUuid($cpl_id, $status);
            return $status;
        }

    }

    public function getRunningIngests()
    {


         $res=   DB::table('ingests')
                ->leftJoin('ingestsources', 'ingests.id_source', '=', 'ingestsources.id')
                ->leftJoin('ingest_dcp_large', 'ingests.cpl_id', '=', 'ingest_dcp_large.id_cpl')
                ->select(
                    DB::raw('MAX(ingest_dcp_large.id_cpl) as id_cpl'),
                    DB::raw('MAX(ingest_dcp_large.id_server) as id_server'),
                    DB::raw('"DCP" AS type'),
                    DB::raw('MAX(ingests.cpl_description) as cpl_description'),
                    DB::raw('MAX(ingests.status) as status'),
                    DB::raw('MAX(ingests.date_create_ingest) as date_create_ingest'),
                    DB::raw('MAX(ingests.date_start_ingesting) as date_start_ingesting'),
                    DB::raw('IFNULL(SUM(ingest_dcp_large.Size),0) AS Total_size'),
                    DB::raw('IFNULL(SUM(ingest_dcp_large.progress),0) AS Total_progress'),
                    DB::raw('ROUND((SUM(ingest_dcp_large.progress)*100/SUM(ingest_dcp_large.Size)),2) AS percentage'),
                    DB::raw('MAX(ingestsources.serverName) AS source'),
                    DB::raw('MAX(ingests.order) AS `order`') // Enclose 'order' within backticks
                )
                ->where('ingests.status', '=', 'running')
                ->groupBy('ingest_dcp_large.id_cpl', 'ingests.order')
                ->orderBy('ingests.order', 'ASC')
                ->get();
                return $res;


    }

    public function getPendingIngests()
    {
        /*
        $q = $this
            ->_db
            ->prepare('SELECT
                       MAX(ingest_dcp_large.id_cpl) as id_cpl,
                       MAX(ingest_dcp_large.id_server) as id_server ,
                       "DCP" AS type,
                         MAX(ingests.cpl_description) as cpl_description,
                           MAX(ingests.status) as status,
                             MAX(ingests.date_create_ingest) as date_create_ingest,
                               MAX(ingests.date_start_ingesting) as date_start_ingesting,
                       IFNULL(SUM(ingest_dcp_large.Size),0) AS "Total_size",
                       IFNULL( SUM(ingest_dcp_large.progress),0) AS "Total_progress",
                       ROUND((SUM(ingest_dcp_large.progress)*100/SUM(ingest_dcp_large.Size)),2 )  AS "percentage",
                        MAX(server.serverName )As "source",
                          MAX(ingests.order )As "order"

                       FROM  ingests
                       LEFT JOIN   server ON ingests.id_source   = server.idserver
                       LEFT JOIN   ingest_dcp_large ON ingests.cpl_id = ingest_dcp_large.id_cpl
                      WHERE ingests.status  ="pending"   OR ingests.status  ="Pending"
                      GROUP BY ingest_dcp_large.id_cpl, ingests.order
                         ORDER BY ingests.order ASC ;');
        try {
            $q->execute();
            return $q->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        */


      $res=  DB::table('ingests')
                ->leftJoin('ingestsources', 'ingests.id_source', '=', 'ingestsources.id')
                ->leftJoin('ingest_dcp_large', 'ingests.cpl_id', '=', 'ingest_dcp_large.id_cpl')
                ->select(
                    DB::raw('MAX(ingest_dcp_large.id_cpl) as id_cpl'),
                    DB::raw('MAX(ingest_dcp_large.id_server) as id_server'),
                    DB::raw('"DCP" AS type'),
                    DB::raw('MAX(ingests.cpl_description) as cpl_description'),
                    DB::raw('MAX(ingests.status) as status'),
                    DB::raw('MAX(ingests.date_create_ingest) as date_create_ingest'),
                    DB::raw('MAX(ingests.date_start_ingesting) as date_start_ingesting'),
                    DB::raw('IFNULL(SUM(ingest_dcp_large.Size),0) AS Total_size'),
                    DB::raw('IFNULL(SUM(ingest_dcp_large.progress),0) AS Total_progress'),
                    DB::raw('ROUND((SUM(ingest_dcp_large.progress)*100/SUM(ingest_dcp_large.Size)),2) AS percentage'),
                    DB::raw('MAX(ingestsources.serverName) AS source'),
                    DB::raw('MAX(ingests.order) AS `order`') // Enclose 'order' within backticks
                )
                ->where('ingests.status', '=', 'Pending')
                ->orWhere('ingests.status', '=', 'pending')
                ->groupBy('ingest_dcp_large.id_cpl', 'ingests.order')
                ->orderBy('ingests.order', 'ASC')
                ->get();
                return $res;

    }



    public function updateDownloadStatusByIdCpl($id_cpl, $status)
    {

        DB::table('ingests')
        ->where('cpl_id', $id_cpl)
        ->update(array('status' => $status ));

        /*
        $q = $this
            ->_db->prepare('UPDATE ingests SET status = ?  WHERE cpl_id = ?  ');
        $q->execute([$status, $id_cpl]);*/
    }

    public function getDcpTmsDirByCplUuid($cpl_uuid)
    {
        $res = DB::table('ingests')
            ->where('cpl_id', $cpl_uuid)
            ->select('tms_dir')
            ->get();

        return $res->tms_dir;

        /*$stmt = $this->_db->prepare('select tms_dir from `ingests` WHERE cpl_id=:cpl_id');
        $stmt->execute(['cpl_id' => $cpl_uuid]);
        return $stmt->fetch()['tms_dir'];*/
    }

    public function removeDcpFiles($tms_dir)
    {
        $command = "rm -rf $tms_dir";
        $output = shell_exec($command);
        echo $output;

    }
    public function deleteMxfByCplUuid($cpl_uuid)
    {

        DB::table('ingest_dcp_large')
        ->where('id_cpl', $cpl_uuid)
        ->delete();

        /*$q2 = $this->_db->prepare('DELETE  FROM ingest_dcp_large   WHERE ingest_dcp_large.id_cpl = :id_cpl');
        try {
            $q2->execute(array(':id_cpl' => $cpl_uuid));
        } catch (PDOException $e) {
        }*/

    }

    public function getDcpLogsDetails($cpl_id_pack)
    {
        try {
            // Fetching ingest records based on cpl_id
            $dcp = DB::table('ingests')
                ->where('cpl_id', $cpl_id_pack)
                ->get();

            // Fetching ingest_dcp_large records based on id_cpl
            $mxf = DB::table('ingest_dcp_large')
                ->select('*', DB::raw('ROUND((progress*100/Size),2) AS percentage'))
                ->where('id_cpl', $cpl_id_pack)
                ->get();

            $response = ["dcp" => $dcp, "mxf" => $mxf];
            return  $response;
            //return response()->json($response);

        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(["error" => $e->getMessage()], 500);
        }

        /*
        $q_ingest = $this->_db->prepare('  SELECT ingests.*   FROM  ingests  WHERE  cpl_id =  :cpl_id  ');
        try {

            $q_ingest->execute(['cpl_id' => $cpl_id_pack]);
            $dcp = $q_ingest->fetchAll();

            $q_large_files = $this->_db
                ->prepare('
            SELECT  ingest_dcp_large.* ,ROUND((ingest_dcp_large.progress*100/ingest_dcp_large.Size),2) AS percentage
            FROM  ingest_dcp_large
            WHERE  id_cpl =  :id_cpl  ');
            $q_large_files->execute(['id_cpl' => $cpl_id_pack]);
            $mxf = $q_large_files->fetchAll();
            $response = array("dcp" => $dcp, "mxf" => $mxf);
            echo json_encode($response);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        try {

            $dcp = DB::table('ingests')
                ->where('cpl_id', $cpl_id_pack)
                ->get();

            // Fetching ingest_dcp_large records based on id_cpl
            $mxf = DB::table('ingest_dcp_large')
                ->select('*', DB::raw('ROUND((progress*100/Size),2) AS percentage'))
                ->where('id_cpl', $cpl_id_pack)
                ->get();

            $response = ["dcp" => $dcp, "mxf" => $mxf];
            return response()->json($response);

        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(["error" => $e->getMessage()], 500);
        } */

    }

    public function DeleteLogsById($id)
    {
        /*$q2 = $this->_db->prepare('DELETE  FROM ingest_scan_errors   WHERE ingest_scan_errors.id = :id');
        try {
            $q2->execute(array(':id' => $id));
        } catch (PDOException $e) {
        }
        */
        DB::table('ingest_scan_errors')
        ->where('id', $id)
        ->delete();

    }

    // playlist builder manager methods

    public function getCplDuration3($cpl_file)
    {
        $totalDuration = 0;
        $namespaces = $cpl_file->getNamespaces(true);
        $namespace = isset($namespaces['msp-cpl']) ? $namespaces['msp-cpl'] : null;

        // Check if the namespace exists and register it
        if ($namespace) {
            $cpl_file->registerXPathNamespace('msp', $namespace);
        }

        foreach ($cpl_file->ReelList->Reel as $reelElement) {
            $reelDuration = 0;

            // Check if MainStereoscopicPicture exists and calculate the duration
            if ($namespace) {
                $mainStereoscopicPicture = $cpl_file->xpath('//msp:MainStereoscopicPicture');
            } else {
                $mainStereoscopicPicture = null;
            }


            if ($mainStereoscopicPicture && isset($mainStereoscopicPicture[0]->Duration)) {
                $stereoscopicPictureDuration = (int)$mainStereoscopicPicture[0]->Duration;
                $reelDuration = max($reelDuration, $stereoscopicPictureDuration);
            } else {
                // Check if MainPicture exists and calculate the duration
                $mainPicture = $reelElement->AssetList->MainPicture;

                if ($mainPicture && isset($mainPicture->Duration)) {
                    $mainPictureDuration = (int)$mainPicture->Duration;
                    $reelDuration = max($reelDuration, $mainPictureDuration);
                }
            }

            // Check if MainSound exists and calculate the duration
            $mainSound = $reelElement->AssetList->MainSound;

            if ($mainSound && isset($mainSound->Duration)) {
                $mainSoundDuration = (int)$mainSound->Duration;
                $reelDuration = max($reelDuration, $mainSoundDuration);
            } elseif ($mainSound && isset($mainSound->IntrinsicDuration)) {
                $mainSoundIntrinsicDuration = (int)$mainSound->IntrinsicDuration;
                $reelDuration = max($reelDuration, $mainSoundIntrinsicDuration);
            }

            // Accumulate the reel duration to the total duration
            $totalDuration += $reelDuration;
        }

        return $totalDuration;
    }

    public function getEditRate2($cpl_file)
    {
        $assetList = $cpl_file->ReelList->Reel->AssetList;

        // Check if MainPicture or MainSound or MainStereoscopicPicture exists
        $mainPictureExists = isset($assetList->MainPicture);
        $mainSoundExists = isset($assetList->MainSound);
        // Check if the msp-cpl namespace exists
        $namespaces = $cpl_file->getNamespaces(true);
        $namespace = isset($namespaces['msp-cpl']) ? $namespaces['msp-cpl'] : null;

        // Check if the namespace exists and register it

        if ($namespace) {
            $cpl_file->registerXPathNamespace('msp', $namespace);
            $mainStereoscopicPictureExists = $cpl_file->xpath('//msp:MainStereoscopicPicture');
        } else {
            $mainStereoscopicPictureExists = null;
        }

        // Initialize the edit rate values
        $editRate = "";
        $numerator = "";
        $denominator = "";

        // Determine the edit rate
        if ($mainPictureExists) {
            $editRate = (string)$assetList->MainPicture->EditRate;
        } elseif ($mainSoundExists) {
            $editRate = (string)$assetList->MainSound->EditRate;
        } elseif ($mainStereoscopicPictureExists && isset($mainStereoscopicPictureExists[0]->EditRate)) {
            $editRate = (string)$mainStereoscopicPictureExists[0]->EditRate;
        }

        // Extract the numerator and denominator values
        if ($editRate !== "") {
            list($numerator, $denominator) = explode(" ", $editRate);
        }

        // Create an array with the edit rate values
        return array(
            'edit_rate' => $editRate,
            'editRate_numerator' => $numerator,
            'editRate_denominator' => $denominator
        );
    }


    /*public function updateCplData($Creator, $EditRate, $editRate_numerator, $editRate_denominator,
                                  $FrameRate, $FrameRate_String, $FrameCount, $edit_rate_duration, $Duration_seconds, $Duration,
                                  $soundChannelCount,
                                  $ScreenAspectRatio, $Width, $Height, $uuid)
    {
        $data = ['Creator' => $Creator,
            'EditRate' => $EditRate, 'editRate_numerator' => $editRate_numerator, 'editRate_denominator' => $editRate_denominator,
            'FrameRate' => $FrameRate, 'FrameRate_String' => $FrameRate_String, 'FrameCount' => $FrameCount,
            'edit_rate_duration' => $edit_rate_duration, 'Duration_seconds' => $Duration_seconds, 'Duration' => $Duration,
            'soundChannelCount' => $soundChannelCount,
            'ScreenAspectRatio' => $ScreenAspectRatio, 'Width' => $Width, 'Height' => $Height,
            'uuid' => $uuid];

        $sql = "UPDATE cpl_data SET
                     Creator=:Creator ,
                     EditRate=:EditRate,editRate_numerator=:editRate_numerator ,editRate_denominator=:editRate_denominator,
                     FrameRate=:FrameRate,FrameRate_String=:FrameRate_String, FrameCount=:FrameCount,
                     edit_rate_duration=:edit_rate_duration,Duration_seconds=:Duration_seconds,Duration=:Duration,
                     soundChannelCount=:soundChannelCount,
                     ScreenAspectRatio=:ScreenAspectRatio,Width=:Width,Height=:Height
                     WHERE  uuid=:uuid";
        $q = $this->_db->prepare($sql);
        $q->execute($data);
    }*/

    public function updateCplData($Creator, $EditRate, $editRate_numerator, $editRate_denominator, $FrameRate, $FrameRate_String, $FrameCount, $edit_rate_duration, $Duration_seconds, $Duration, $soundChannelCount, $ScreenAspectRatio, $Width, $Height, $uuid)
    {
        $data = [
            'Creator' => $Creator,
            'EditRate' => $EditRate,
            'editRate_numerator' => $editRate_numerator,
            'editRate_denominator' => $editRate_denominator,
            'FrameRate' => $FrameRate,
            'FrameRate_String' => $FrameRate_String,
            'FrameCount' => $FrameCount,
            'edit_rate_duration' => $edit_rate_duration,
            'Duration_seconds' => $Duration_seconds,
            'Duration' => $Duration,
            'soundChannelCount' => $soundChannelCount,
            'ScreenAspectRatio' => $ScreenAspectRatio,
            'Width' => $Width,
            'Height' => $Height,
            'uuid' => $uuid
        ];

        DB::table('cpl_data')
            ->where('uuid', $uuid)
            ->update($data);
    }






    public function updateCplNeedKdm($uuid, $kdm_required)
    {

        DB::table('cpl_data')
        ->where('uuid', $uuid)
        ->update(array('kdm_required' => $kdm_required ));

        /*$q = $this->_db->prepare('UPDATE cpl_data SET  kdm_required = ?  WHERE uuid = ?  ');
        $q->execute([$kdm_required, $uuid]);*/
    }



    function secondsToHms($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }


    public function updateIngestStatusByCplUuid($uuid_cpl, $status)
    {
        DB::table('ingests')
        ->where('cpl_id', $uuid_cpl)
        ->update(array('status' => $status ));

        /*$q = $this
            ->_db->prepare('UPDATE ingests SET status = ?  WHERE cpl_id = ?  ');
        $q->execute([$status, $uuid_cpl]);*/


    }
    public function checkLocalCplNeedsKdm($reelList)
    {
        $hasKeyId = false;

        // Check if ReelList contains more than one reel
        if (isset($reelList['Reel'][0])) {
            foreach ($reelList['Reel'] as $reel) {
                if (isset($reel['AssetList']['MainPicture']['KeyId'])) {
                    $hasKeyId = true;
                    break;
                }
            }
        } else {
            // If there's only one reel, directly check its KeyId
            $reel = $reelList['Reel'];
            if (isset($reel['AssetList']['MainPicture']['KeyId'])) {
                $hasKeyId = true;
            }
        }

        return $hasKeyId ? 1 : 0;

    }


    public function updateIngestEndDownloadByCplUuid($uuid_cpl, $date_end_ingest)
    {

        DB::table('ingests')
            ->where('cpl_id', $uuid_cpl)
            ->update(['date_end_ingest' => $date_end_ingest]);

        /*
        $q = $this
            ->_db->prepare('UPDATE ingests SET date_end_ingest = ?  WHERE cpl_id = ?  ');
        $q->execute([$date_end_ingest, $uuid_cpl]); */
    }

    public function script_ingester()
    {
        // $soapManagement = new SoapManagement();
        $ingester_manager = new IngesterManager();
        //$manager_server = new ServerManager(getdb());
        $counter = 0;


        while ($counter < 16) {
            $list_ingests=$this->getListIngest();
            foreach ($list_ingests AS $ingest){
                $pack_ingest=$this->getIngestFiles($ingest->cpl_id);
                $this->ingestHasMxf($ingest->cpl_id);

                if ($this->ingestHasMxf($ingest->cpl_id)==0) {
                    $this->updateIngestStatusByCplUuid($ingest->cpl_id, "Complete");
                    $date_start_ingest = date('Y-m-d H:i:s');
                    $this-> updateIngestStartDownloadByCplUuid($ingest->cpl_id,$date_start_ingest);
                    $date_end_ingest = date('Y-m-d H:i:s');
                    $this-> updateIngestEndDownloadByCplUuid($ingest->cpl_id,$date_end_ingest);
                    $this->updateIngestHasMxf($ingest->cpl_id,0);

                }
            else{
                    if($this->checkRunningExist()==0){
                        if($this->checkDownloadStatus($ingest->cpl_id)=="Paused"){
                            continue;
                        }
                        $this->updateIngestStatusByCplUuid($ingest->cpl_id, "running");
                        $date_start_ingest = date('Y-m-d H:i:s');
                        $this-> updateIngestStartDownloadByCplUuid($ingest->cpl_id,$date_start_ingest);
                        $this->updateIngestHasMxf($ingest->cpl_id,1);
                        $this->startDownloadPackIngest($pack_ingest,$ingest->cpl_id,$ingest->server_ip,$ingest->usernameServer,$ingest->passwordServer );
                        break;
                    }
                }

            }
            usleep(3000000); // Sleep for 4 seconds (4,000,000 microseconds)

            $counter++;
        }


    }




    public function getErrorsScan()
    {
        $errors = DB::table('ingest_scan_errors')
            ->select(
                'ingest_scan_errors.id',
                'ingest_scan_errors.title',
                'ingest_scan_errors.content',
                'ingest_scan_errors.file_path',
                'ingest_scan_errors.date_time',
                'ingest_scan_errors.type',
                'ingestsources.serverName'
            )
            ->leftJoin('ingestsources', 'ingest_scan_errors.id_server', '=', 'ingestsources.id')
            ->orderBy('ingest_scan_errors.id', 'DESC')
            ->get();

            if(count($errors) > 0 )
            {
                return $errors ;
            }else
            {
                return 0 ;
            }
        //return Response()->json(compact('errors'));

        /*$dbDetails = getdb();
        $table = <<<EOT
        (
            SELECT
            ingest_scan_errors.id  ,
            ingest_scan_errors.title,
            ingest_scan_errors.content ,
            ingest_scan_errors.file_path,
            ingest_scan_errors.date_time,
            ingest_scan_errors.type,
            server.serverName
        FROM
            ingest_scan_errors
        LEFT JOIN server ON ingest_scan_errors.id_server = server.idserver
            ORDER BY ingest_scan_errors.id DESC
         )AS temp
        EOT;
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'content', 'dt' => 2),
            array('db' => 'file_path', 'dt' => 3),
            array('db' => 'date_time', 'dt' => 4),
            array('db' => 'type', 'dt' => 5),
            array('db' => 'serverName', 'dt' => 6),
        );

        echo json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns));


            */
    }


    public function prepareLocalPath($OriginalFileName, $tms_dir)
    {
        $isDirectory = (strpos($OriginalFileName, '/') !== false);
        if ($isDirectory) {
            $directory = dirname($OriginalFileName);
            $localDirectoryPath = $tms_dir . '/' . $directory;
            if (!is_dir($localDirectoryPath)) {
                mkdir($localDirectoryPath, 0777, true);
            }
            $localFilePath = $tms_dir . '/' . $OriginalFileName;
        } else {
            $localFilePath = $tms_dir . '/' . $OriginalFileName;
        }
        return $localFilePath;
    }


    public function prepareRemotePathUri($pkl_uri)
    {
        $prefix = 'data/';
        if (substr($pkl_uri, 0, strlen($prefix)) == $prefix) {
            $uri = substr($pkl_uri, strlen($prefix));
        } else {
            $uri = $pkl_uri;
        }
        return $uri;
    }

    public function getDirectory($file)
    {
        return pathinfo($file, PATHINFO_DIRNAME);
    }


    public function updateMxfFileStatusByIdAndCPlId($status, $id_file, $cpl_id)
    {

        DB::table('ingest_dcp_large')
        ->where('id_file', $id_file)
        ->where('id_cpl', $cpl_id)
        ->update(array('status' => $status));

        /*$q = $this
            ->_db->prepare('UPDATE ingest_dcp_large SET status = ?  WHERE id_file = ? AND id_cpl=? ');
        $q->execute([$status, $id_file, $cpl_id]); */
    }



    public function updateProgressLargeFileByIdAndCplId($id, $progress, $id_cpl)
    {

        $date_create_ingest = date('Y-m-d H:i:s');

        DB::table('ingest_dcp_large')
        ->where('id_file', $id)
        ->where('id_cpl', $id_cpl)
        ->update(array('progress' => $progress, 'date_create_ingest' => $date_create_ingest ));

        /*$q = $this
            ->_db->prepare('UPDATE ingest_dcp_large SET progress = ?,  date_create_ingest = ? WHERE id_file = ? AND id_cpl =? ');
        $q->execute([$progress, $date_create_ingest, $id, $id_cpl]);*/
    }


    public function hashFile($file_path)
    {
        $sha1Checksum = sha1_file($file_path, true);

        // Encode the binary checksum using base64
        $base64Checksum = base64_encode($sha1Checksum);
        // echo $base64Checksum;
        return $base64Checksum;
    }

    public function getHashMxf($id_file)
    {


        try {
            $result = DB::table('ingest_dcp_large')
                ->select('Hash')
                ->where('id_file', $id_file)
                ->first();

            if ($result) {
                return $result->Hash;
            } else {
                return null; // or handle the case where no result is found
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        /*$q = $this->_db->prepare('SELECT  Hash  FROM ingest_dcp_large WHERE  id_file  = ? ');
        try {
            $q->execute(array($id_file));
            $result = $q->fetch();
            return ($result['Hash']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/

    }

    public function updateHashStatus($status, $id_file)
    {

        DB::table('ingest_dcp_large')
            ->where('id_file', $id_file)
            ->update(['hash_verified' => $status]);

        /*$q = $this
            ->_db->prepare('UPDATE ingest_dcp_large SET hash_verified = ?  WHERE id_file = ?  ');
        $q->execute([$status, $id_file]);*/
    }


    public function updateMxfFileStatus($status, $id_file)
    {
        DB::table('ingest_dcp_large')
            ->where('id_file', $id_file)
            ->update(['status' => $status]);
        /*
        $q = $this
            ->_db->prepare('UPDATE ingest_dcp_large SET status = ?  WHERE id_file = ?  ');
        $q->execute([$status, $id_file]);*/
    }

    public function countPackMxfFiles($id_cpl)
    {
        try {
            $result = DB::table('ingest_dcp_large')
                ->selectRaw('COUNT(*) AS pack_nbr')
                ->where('id_cpl', $id_cpl)
                ->first();

            if ($result) {
                return $result->pack_nbr;
            } else {
                return 0; // or handle the case where no result is found
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        /*
        $q = $this->_db->prepare('SELECT COUNT(*)  AS pack_nbr FROM  ingest_dcp_large where id_cpl = ?');
        try {
            $q->execute(array($id_cpl));
            $result = $q->fetch(PDO::FETCH_ASSOC);
            return $result['pack_nbr'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
    }

    public function customErrorHandler($errno, $errstr, $errfile, $errline)
    {
        // Check if the error message matches the specific warning
        if (stripos($errstr, 'ftp_nb_fget(): Failed to open file.') !== false) {
            // Save the error in the database or perform any other desired action
            // Example: code to save the error in a database table
            $errorMessage = 'FTP file open error: ' . $errstr;
            // Your code to save the error message in the database goes here
            // ...
            // Output the error message for debugging or logging purposes
            echo $errorMessage;
        }
        // You can also log the error to a file or perform other actions for different error types if needed
    }


    public function getDcpLogs()
    {
        try {
            $result = DB::table('ingests')
                ->select(
                    '*',
                    DB::raw('"DCP" AS type'),
                    'ingestsources.serverName AS source',
                    DB::raw('(SELECT MAX(date_create_ingest) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id) AS date_finished_ingest'),
                    DB::raw('IFNULL((SELECT SUM(ingest_dcp_large.Size) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0) AS Total_size'),
                    DB::raw('IFNULL((SELECT SUM(ingest_dcp_large.progress) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0) AS Total_progress'),
                    DB::raw('IFNULL(ROUND(
                                    IFNULL((SELECT SUM(ingest_dcp_large.progress) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0) * 100 /
                                    IFNULL((SELECT SUM(ingest_dcp_large.Size) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0)
                                    ,2),
                                0) AS percentage'),
                    DB::raw('(SELECT IF(COUNT(*) = SUM(ingest_dcp_large.hash_verified), 1, 0) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id) AS all_verified')
                )
                ->leftJoin('ingestsources', 'ingests.id_source', '=', 'ingestsources.id')
                ->whereNotIn('ingests.status', ['Running', 'pending', 'Pending', 'running'])
                ->orderByDesc('ingests.order')
                ->get();

            return $result;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function get_transfere_content()
    {
        try {
            $result = DB::table('ingests')
                ->select(
                    '*',
                    DB::raw('"DCP" AS type'),
                    'ingestsources.serverName AS source',
                    DB::raw('(SELECT MAX(date_create_ingest) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id) AS date_finished_ingest'),
                    DB::raw('IFNULL((SELECT SUM(ingest_dcp_large.Size) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0) AS Total_size'),
                    DB::raw('IFNULL((SELECT SUM(ingest_dcp_large.progress) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0) AS Total_progress'),
                    DB::raw('IFNULL(ROUND(
                                    IFNULL((SELECT SUM(ingest_dcp_large.progress) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0) * 100 /
                                    IFNULL((SELECT SUM(ingest_dcp_large.Size) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id), 0)
                                    ,2),
                                0) AS percentage'),
                    DB::raw('(SELECT IF(COUNT(*) = SUM(ingest_dcp_large.hash_verified), 1, 0) FROM ingest_dcp_large WHERE ingest_dcp_large.id_cpl = ingests.cpl_id) AS all_verified')
                )
                ->leftJoin('ingestsources', 'ingests.id_source', '=', 'ingestsources.id')
                ->leftJoin('ingest_dcp_large', 'ingest_dcp_large.id_cpl', '=', 'ingests.cpl_id')
                ->where('ingests.status', 'Complete')
                ->where('ingest_dcp_large.hash_verified','!=', 0)
                ->orderByDesc('ingests.order')
                ->get();

            return $result;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


}





