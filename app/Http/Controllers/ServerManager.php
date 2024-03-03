<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDOException;

class ServerManager extends Controller
{
    private $_db; // Instance de PDO

    // Instance de PDO
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function validateIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }


    public function isSessionExpired($lastUpdateDate)
    {
        $currentTime = time();
        $lastUpdateTime = strtotime($lastUpdateDate);
        $timeDifference = $currentTime - $lastUpdateTime;
        $expirationTime = 3 * 60; // 120 minutes = 120 * 60 seconds

        return ($timeDifference > $expirationTime);
    }

    public function checkLibraryNameForUpdate($server_name)
    {
        $stmt = $this->_db->prepare('select serverName, COUNT(*) AS name_occurrence from `server` WHERE serverName=:serverName');
        $stmt->execute(['serverName' => $server_name]);
        return $stmt->fetch();
    }

    public function checkLibraryAuditoriumNumber($auditorium_number)
    {
        $stmt = $this->_db->prepare('select number, COUNT(*) AS auditorium_number_occurrence from `auditorium` WHERE number=:number');
        $stmt->execute(['number' => $auditorium_number]);
        return $stmt->fetch();
    }

    public function add(server $server)
    {
        $q = $this
            ->_db
            ->prepare('INSERT INTO
                                 server(serverType, serverName, screenModel, playback, sound, server_ip,
                                        ingestProtocol, usernameServer, passwordServer, remotPath, managment_ip,
                                         ingestProtocolAdmin, usernameAdmin, passwordAdmin,
                                        auditorium_idauditorium)
                              VALUES(:serverType, :serverName, :screenModel, :playback, :sound, :server_ip,
                                     :ingestProtocol, :usernameServer, :passwordServer,:remotPath,:managment_ip,
                                      :ingestProtocolAdmin, :usernameAdmin, :passwordAdmin,
                                     :idAuditorium )');

        $q->bindValue(':serverType', $server->getserverType());
        $q->bindValue(':serverName', $server->getServerName());
        $q->bindValue(':screenModel', $server->getScreenModel());
        $q->bindValue(':playback', $server->getPlayback());
        $q->bindValue(':sound', $server->getSound());
        $q->bindValue(':server_ip', $server->getServerIp());
        $q->bindValue(':ingestProtocol', $server->getIngestProtocol());
        $q->bindValue(':usernameServer', $server->getUsernameServer());
        $q->bindValue(':passwordServer', $server->getPasswordServer());
        $q->bindValue(':remotPath', $server->getRemotpathProtocol());
        $q->bindValue(':managment_ip', $server->getManagementIp());
        // $q->bindValue(':filetype', $server->getFiletype());
        $q->bindValue(':ingestProtocolAdmin', $server->getIngestProtocol());
        $q->bindValue(':usernameAdmin', $server->getUsernameAdmin());
        $q->bindValue(':passwordAdmin', $server->getPasswordAdmin());
        $q->bindValue(':idAuditorium', $server->getAuditoriumIdauditorium());
        try {
            $q->execute();
            $LAST_ID = $this->_db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertServer($server_type, $server_name, $screen_model, $playback, $sound, $server_ip, $ingestProtocol, $usernameServer, $passwordServer, $remotPath, $managment_ip, $ingest_protocol_admin, $username_admin, $password_admin, $auditorium_idauditorium)
    {
        $sql = "INSERT INTO server (serverType, serverName, screenModel, playback, sound, server_ip, ingestProtocol, usernameServer, passwordServer, remotPath, managment_ip, ingestProtocolAdmin, usernameAdmin, passwordAdmin, auditorium_idauditorium)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->_db->prepare($sql)->execute([$server_type, $server_name, $screen_model, $playback, $sound, $server_ip, $ingestProtocol, $usernameServer, $passwordServer, $remotPath, $managment_ip, $ingest_protocol_admin, $username_admin, $password_admin, $auditorium_idauditorium]);
    }

    public function getServerByAuditorium($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where auditorium_idauditorium = ?');

        try {
            $q->execute(array($id));

            $result = $q->fetch() ?: null;

            $server = new Server($result['serverType'],
                $result['serverName'],
                $result['screenModel'],
                $result['playback'],
                $result['sound'],
                $result['server_ip'],
                $result['ingestProtocol'],
                $result['usernameServer'],
                $result['passwordServer'],
                $result['remotPath'],
                $result['managment_ip'],
                //$result['filetype'],
                $result['ingestProtocolAdmin'],
                $result['usernameAdmin'],
                $result['passwordAdmin'],
                $result['auditorium_idauditorium']);

            $server->setId($result['idserver']);

            return ($server);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getServerByAuditorium2($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where auditorium_idauditorium = ?');

        try {
            $q->execute(array($id));

            $result = $q->fetch() ?: null;

            $server = new Server($result['serverType'],
                $result['serverName'],
                $result['screenModel'],
                $result['playback'],
                $result['sound'],
                $result['server_ip'],
                "",
                $result['usernameServer'],
                $result['passwordServer'],
                $result['remotPath'],
                $result['managment_ip'],
                //$result['filetype'],
                $result['ingestProtocolAdmin'],
                $result['usernameAdmin'],
                $result['passwordAdmin'],
                $result['auditorium_idauditorium']);

            $server->setId($result['idserver']);

            return ($result);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getAllServerData()
    {
        $q = $this->_db
            ->prepare('SELECT server.idserver as id_server,server.serverName,server.playback,
                              server.managment_ip,server.usernameAdmin,server.passwordAdmin,server.serverType,
                              server.storage_configuration,server.storage_ip,
                              server.enable_power_control,
                              server.projector_ip,
                              auditorium.idauditorium AS id_auditorium, auditorium.number As number_auditorium,
                              soundprocessormodel.title AS sound_model
                       FROM  auditorium
                       LEFT JOIN   server ON auditorium.idauditorium = server.auditorium_idauditorium
                       LEFT JOIN   soundprocessormodel ON server.sound_model = soundprocessormodel.idsoundProcessorModel
                       where server.serverType = ? AND 	auditorium.issecreen=1');
        try {
            $q->execute(array("Screen"));

            return $q->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getServersData()
    {
        $q = $this->_db
            ->prepare('SELECT server.idserver as id_server,server.serverName,server.playback,
                              server.managment_ip,server.usernameAdmin,server.passwordAdmin,server.serverType,
                              server.storage_configuration,server.storage_ip,
                              server.enable_power_control,
                              server.projector_ip,
                               server.sound_ip,
                              auditorium.idauditorium AS id_auditorium, auditorium.number As number_auditorium,
                              soundprocessormodel.title AS sound_model,
                               soap_sessions.session_id as soap_session
                       FROM  auditorium
                       LEFT JOIN   server ON auditorium.idauditorium = server.auditorium_idauditorium
                       LEFT JOIN   soundprocessormodel ON server.sound_model = soundprocessormodel.idsoundProcessorModel
                       LEFT JOIN   screens_monitoring ON server.idserver = screens_monitoring.screen_id
                      LEFT JOIN   soap_sessions   ON server.idserver = soap_sessions.id_server

                       where server.serverType = ? AND 	auditorium.issecreen=1');
        try {
            $q->execute(array("Screen"));

            return $q->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getServerData($id_server)
    {
        $q = $this->_db
            ->prepare('SELECT server.idserver as id_server,server.serverName,server.playback,
                               server.managment_ip,server.usernameAdmin,server.passwordAdmin,
                               server.serverType,server.usb_content,server.sound_ip,
                               server.default_content,
                                server.remotPath,
                               server.server_ip,server.usernameServer,server.passwordServer,
                               server.projector_ip,
                               server.sound_ip,
                               auditorium.idauditorium AS id_auditorium, auditorium.number As number_auditorium,
                               screens_monitoring.soap_session,
                               soundprocessormodel.title AS sound_model,
                               soap_sessions.session_id
                        FROM  auditorium

                        LEFT JOIN   server ON auditorium.idauditorium = server.auditorium_idauditorium
                        LEFT JOIN   soap_sessions   ON server.idserver = soap_sessions.id_server
                        LEFT JOIN   screens_monitoring ON server.idserver = screens_monitoring.screen_id
                        LEFT JOIN   soundprocessormodel ON server.sound_model = soundprocessormodel.idsoundProcessorModel
                        WHERE idserver = ?');
        try {
            $q->execute(array($id_server));
            return $q->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getLibraryData($id_library)
    {
        $q = $this->_db
            ->prepare('SELECT server.idserver as id_server,server.serverName,
                                server.serverType,server.default_location, server.default_content, server.usb_content,
                               server.server_ip,server.usernameServer,server.passwordServer
                        FROM  server
                        WHERE idserver = ?');
        try {
            $q->execute(array($id_library));
            return $q->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getListSources()
    {
        $servers = $this
            ->_db
            ->prepare('SELECT idserver,serverName,serverType FROM  server WHERE serverType="Screen" OR default_content= 1 ');
        try {
            $servers->execute();
            return  $servers->fetchAll(PDO::FETCH_ASSOC) ;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getListSourcesKdms()
    {
        $servers = $this
            ->_db
            ->prepare('SELECT idserver,serverName,serverType,default_content FROM  server   ');
        try {
            $servers->execute();
            return  $servers->fetchAll(PDO::FETCH_ASSOC) ;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getListScreens()
    {
        $servers = $this
            ->_db
            ->prepare('SELECT idserver,serverName,serverType FROM  server WHERE serverType="Screen"  ');
        try {
            $servers->execute();
            return  $servers->fetchAll(PDO::FETCH_ASSOC) ;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getServerDataByAuditoriumNumber($auditorium_number)
    {
        $q = $this->_db
            ->prepare('SELECT server.idserver as id_server,server.serverName,
                               server.managment_ip,server.usernameAdmin,server.passwordAdmin,server.serverType,
                               auditorium.idauditorium AS id_auditorium, auditorium.number As number_auditorium

                        FROM  auditorium
                        LEFT JOIN   server ON auditorium.idauditorium = server.auditorium_idauditorium
                         WHERE auditorium.number = ?');
        try {
            $q->execute(array($auditorium_number));
            return $q->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getServerAllData($id_server)
    {
        $q = $this->_db
            ->prepare('SELECT server.idserver as id_server,server.serverName,server.playback,
                              server.managment_ip,server.usernameAdmin,server.passwordAdmin,server.serverType,server.projector_ip,server.enable_power_control,
                              auditorium.idauditorium AS id_auditorium, auditorium.number As number_auditorium,
                              oid_projector.oid_projector_serial_number,oid_projector.oid_projector_power_stat,
                              soundprocessormodel.title AS sound_model,
                              server.sound_ip
                       FROM  auditorium
                       LEFT JOIN   server ON auditorium.idauditorium = server.auditorium_idauditorium
                       LEFT JOIN   model ON server.projector_model = model.idmodel
                       LEFT JOIN   oid_projector ON model.idmodel = oid_projector.id_model
                       LEFT JOIN   soundprocessormodel ON server.sound_model = soundprocessormodel.idsoundProcessorModel
                       where idserver = ?');
        try {
            $q->execute(array($id_server));
            return $q->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
//    public function getServerById($id)
//    {
//        $q = $this
//            ->_db
//            ->prepare('SELECT * FROM  server where idserver = ?');
//
//        try {
//            $q->execute(array($id));
//
//            $result = $q->fetch();
//
//            $server = new Server($result['serverType'],
//                $result['serverName'],
//                $result['screenModel'],
//                $result['playback'],
//                $result['sound'],
//                $result['server_ip'],
//                $result['ingestProtocol'],
//                $result['usernameServer'],
//                $result['passwordServer'],
//                $result['remotPath'],
//                $result['managment_ip'],
//                //$result['filetype'],
//                $result['ingestProtocolAdmin'],
//                $result['usernameAdmin'],
//                $result['passwordAdmin'],
//                $result['auditorium_idauditorium']);
//
//            $server->setId($result['idserver']);
//
//            return ($server);;
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        return Null;
//    }

    public function getServerById2($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where idserver = ?');

        try {
            $q->execute(array($id));
            return $q->fetch();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getServerByDnCn($dn, $cn)
    {
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $this
            ->_db
            ->prepare('SELECT server.*,auditorium.number FROM  server
                             LEFT JOIN   auditorium ON server.auditorium_idauditorium = auditorium.idauditorium

                             WHERE (jp2k_dnQualifier = ? AND jp2k_cn=?) OR dolby_audio_processor_dnQualifier=?');

        try {
            $q->execute(array($dn, $cn, $dn));
            $result = $q->fetch();
            if ($result) {
                return $result;
            } else {
                return 0;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }

    }

    public function getServerByDnCn2($dn, $cn,$serial_number)
    {
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $this
            ->_db
            ->prepare('SELECT server.*,auditorium.number FROM  server
                             LEFT JOIN   auditorium ON server.auditorium_idauditorium = auditorium.idauditorium

                             WHERE (jp2k_dnQualifier = ? AND jp2k_cn=?)
                                OR dolby_audio_processor_dnQualifier=?
                                OR serial_number=?');

        try {
            $q->execute(array($dn, $cn, $dn,$serial_number));
            $result = $q->fetch();
            if ($result) {
                return $result;
            } else {
                return 0;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }

    }

    function sortArrayByScreenNumber($kdmArray)
    {
        // Custom sorting function
        $sortFunction = function ($a, $b) {
            return $a['screen_number'] <=> $b['screen_number'];
        };

        // Sort the array based on screen_number
        usort($kdmArray, $sortFunction);

        return $kdmArray;
    }

    public function getServerConfigurationsById($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where idserver = ?');

        try {
            $q->execute(array($id));
            return $q->fetch();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getServerConfigurationsByIP($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where idserver = ?');

        try {
            $q->execute(array($id));
            return $q->fetch();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getServerFtpById($id)
    {
        $q = $this
            ->_db
            ->prepare('SELECT serverName, server_ip,usernameServer,passwordServer FROM  server where idserver = ?');
        try {
            $q->execute(array($id));
            return $result = $q->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return Null;
        }
    }

    public function getDefaultLocation()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where default_location = ?');

        try {
            $q->execute(array(1));

            $result = $q->fetch();

            $server = new Server($result['serverType'],
                $result['serverName'],
                $result['screenModel'],
                $result['playback'],
                $result['sound'],
                $result['server_ip'],
                $result['ingestProtocol'],
                $result['usernameServer'],
                $result['passwordServer'],
                $result['remotPath'],
                $result['managment_ip'],
                //$result['filetype'],
                $result['ingestProtocolAdmin'],
                $result['usernameAdmin'],
                $result['passwordAdmin'],
                $result['auditorium_idauditorium']);

            $server->setId($result['idserver']);

            return ($server);;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getDefaultContentServerData()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where default_content = ?');

        try {
            $q->execute(array(1));

            return $q->fetch();


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getListServers()
    {
        $q = $this
            ->_db
            ->prepare('SELECT idserver as id_server ,serverName as server_name ,auditorium_idauditorium
                       FROM  server
                       LEFT JOIN auditorium   ON server.auditorium_idauditorium  =   auditorium.idauditorium
                       WHERE serverType = ? order by auditorium.number ');
        try {
            $q->execute(array("Screen"));
            return $q->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function checkDefaultContent()
    {
        $stmt = $this->_db->prepare("SELECT idserver, COUNT(idserver) as nbr_server FROM server WHERE default_content=?");
        $stmt->execute(["1"]);
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        } else {
            return $result;
        }
    }

    public function getServers()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where serverType = ?');
        try {
            $q->execute(array("Screen"));
            return $q;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getScreensForScheduler()
    {
        $q = $this
            ->_db
            ->prepare('SELECT   serverName as "name",idserver as "id" FROM  server where serverType = ?');
        try {
            $q->execute(array("Screen"));
            echo json_encode($q->fetchall(PDO::FETCH_OBJ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getScreensForSchedule()
    {
        $q = $this
            ->_db
            ->prepare('SELECT   serverName as "name",idserver as "id", auditorium.number as number
                       FROM  server
                        LEFT JOIN   auditorium ON auditorium.idauditorium = server.auditorium_idauditorium
                       where serverType = ?');
        try {
            $q->execute(array("Screen"));
            return $q->fetchall(PDO::FETCH_OBJ);
        } catch (PDOException $e) {

            return $e->getMessage();
        }
    }


    public function getScreensList()
    {

        $q = $this
            ->_db
            ->prepare('SELECT auditorium_idauditorium,serverName FROM  server where serverType = ?');
        try {
            $q->execute(array("Screen"));
            echo json_encode($q->fetchall());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function returnScreensList()
    {

        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where serverType = ?');
        try {
            $q->execute(array("Screen"));
            return $q->fetchall();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllServers()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server  ');

        try {

            $q->execute(array("Screen"));

            return $q;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getServersAndLibraries()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where  default_content IS NULL OR default_content = 0 ');
        try {

            $q->execute();
            return $q;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getSourcesIngest()
    {
        $q = $this
            ->_db
            ->prepare('SELECT server.idserver ,server.serverName,server.serverType FROM  server where  default_content IS NULL OR default_content = 0  ');
        try {

            $q->execute();
            return $q;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }
    public function getLibrary()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where serverType = ? ');

        try {
            $q->execute(array("Ingest"));

            return $q;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getIdDefaultContentData()
    {
        $q = $this
            ->_db
            ->prepare('SELECT * FROM  server where default_content = ? LIMIT 1 ');

        try {
            $q->execute(array(1));
            return $q->fetch();

        } catch (PDOException $e) {
            echo $e->getMessage();

            return null;
        }


    }

    public function getIdDefaultContent()
    {
        $q = $this
            ->_db
            ->prepare('SELECT idserver FROM  server where default_location = ? LIMIT 1 ');

        try {
            $q->execute(array(1));
            $result = $q->fetch();
            return $result['idserver'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }


    }

    public function insertLibrary(server $server)
    {
        $q = $this
            ->_db
            ->prepare('INSERT INTO
                                 server(default_location, default_content, usb_content, serverType, serverName, screenModel, playback, sound, server_ip,
                                        ingestProtocol_server, usernameServer, passwordServer, remotPath, managment_ip,
                                         ingestProtocolAdmin, usernameAdmin, passwordAdmin,
                                        auditorium_idauditorium)
                              VALUES(:default_location, :default_content, :usb_content, :serverType, :serverName, :screenModel, :playback, :sound, :server_ip,
                                     :ingestProtocol_server, :usernameServer, :passwordServer,:remotPath,:managment_ip,
                                      :ingestProtocolAdmin, :usernameAdmin, :passwordAdmin,
                                     :idAuditorium )');

        $q->bindValue(':default_location', $server->getDefaultLocation());
        $q->bindValue(':default_content', $server->getDefaultContent());
        $q->bindValue(':usb_content', $server->getUsbContent());
        $q->bindValue(':serverType', $server->getserverType());
        $q->bindValue(':serverName', $server->getServerName());
        $q->bindValue(':screenModel', $server->getScreenModel());
        $q->bindValue(':playback', $server->getPlayback());
        $q->bindValue(':sound', $server->getSound());
        $q->bindValue(':server_ip', $server->getServerIp());
        $q->bindValue(':ingestProtocol_server', $server->getIngestProtocol());
        $q->bindValue(':usernameServer', $server->getUsernameServer());
        $q->bindValue(':passwordServer', $server->getPasswordServer());
        $q->bindValue(':remotPath', $server->getRemotpathProtocol());
        $q->bindValue(':managment_ip', $server->getManagementIp());
        // $q->bindValue(':filetype', $server->getFiletype());
        $q->bindValue(':ingestProtocolAdmin', $server->getIngestProtocol());
        $q->bindValue(':usernameAdmin', $server->getUsernameAdmin());
        $q->bindValue(':passwordAdmin', $server->getPasswordAdmin());
        $q->bindValue(':idAuditorium', $server->getAuditoriumIdauditorium());
        try {
            $q->execute();
            $LAST_ID = $this->_db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateLibrary($serverName, $default_location, $default_content, $usb_content, $server_ip, $ingestProtocol, $usernameServer, $passwordServer, $Path, $idserver)
    {
        $data = [
            'default_location' => $default_location,
            'default_content' => $default_content,
            'usb_content' => $usb_content,
            'serverName' => $serverName,
            'server_ip' => $server_ip,
            'ingestProtocol_server' => $ingestProtocol,
            'usernameServer' => $usernameServer,
            'passwordServer' => $passwordServer,
            'remotPath' => $Path,
            'idserver' => $idserver,
        ];
        $sql = "UPDATE server SET default_location=:default_location,
                                  default_content=:default_content,
                                  usb_content=:usb_content,
                                  serverName=:serverName,
                                  server_ip=:server_ip,
                                  ingestProtocol_server=:ingestProtocol_server,
                                  usernameServer=:usernameServer,
                                  passwordServer=:passwordServer,
                                  remotPath=:remotPath
                WHERE idserver=:idserver";
        $q = $this
            ->_db
            ->prepare($sql);

        $q->execute($data);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function getIdServer($name)
    {
        $q = $this
            ->_db
            ->prepare('SELECT idserver FROM  server where  serverName = ?');

        try {
            $q->execute(array($name));

            $result = $q->fetch();
            $id = $result['idserver'];

            return ($id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getFirstIdServer()
    {
        $q = $this
            ->_db
            ->prepare('SELECT idserver FROM  server  LIMIT 1');
        try {
            $q->execute();
            $result = $q->fetch();
            $id = $result['idserver'];
            return ($id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getIpByAuditorium($auditorium_idauditorium)
    {
        $q = $this
            ->_db
            ->prepare('SELECT server_ipFROM  server where auditorium_idauditorium = ?');

        try {
            $q->execute(array($auditorium_idauditorium));

            $result = $q->fetch() ?: null;

            $id = $result['idserver'];

            return ($id);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getIpByIdServer($id_server)
    {
        $q = $this
            ->_db
            ->prepare('SELECT server_ip  FROM server where idserver = ?');

        try {
            $q->execute(array($id_server));

            $result = $q->fetch() ?: null;

            return $result['server_ip'];

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function getFirstIdLibrary()
    {
        $q = $this
            ->_db
            ->prepare('SELECT idserver FROM  server where serverType = ? LIMIT 1');
        try {

            $q->execute(array("Ingest"));
            $result = $q->fetch();
            $id = $result['idserver'];
            return ($id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return Null;
    }

    public function deleteServer($id)
    {
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $this
            ->_db
            ->prepare('DELETE from server where  idserver = :id');
        $q->bindParam(':id', $id);
        $q->execute();
        $response = array();
        try {
            $q->execute();

            $response['status'] = 'success';

            $response['message'] = 'server deleted';


        } catch (PDOException $e) {
            $response['status'] = 'error';

            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
    }


    public function getScreenTypeById($id_server)
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
    }

}
