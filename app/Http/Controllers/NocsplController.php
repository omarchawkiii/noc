<?php

namespace App\Http\Controllers;

use App\Models\Lmscpl;
use App\Models\Location;
use App\Models\Nocspl;
use Illuminate\Http\Request;
use SoulDoit\DataTable\SSP;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NocsplController extends Controller
{

    public function createlocalspl(Request $request)
    {
        $uuid =  $this->generateUuid();

        $IssueDate = Carbon::now();

        $file = $this->generateSplXml($uuid, $request->title_spl, $request->hfr, $request->display_mode, $request->items_spl, $IssueDate, 'add') ;

        $file_name = "$uuid.xml" ;
        $file_url = Storage::disk('local')->put( $file_name, $file) ;

        $duration = $this->calculateSplDuration(simplexml_load_string($file));
        $new_nocspl = Nocspl::create([
            'uuid' => $uuid ,
            'spl_title' => $request->title_spl,
            'display_mode'=>$request->display_mode,
            'spl_properties_hfr'=>$request ,
            'xmlpath'=>$file_name,
            'duration'=> $duration,
            'location_id'=> null,
            'source'=> "NOC",
        ]) ;
/*
        foreach($request->items_spl as $noccpl)
        {
            $cpl = Lmscpl::where('uuid', $noccpl['uuid'] )->first() ;
                if($noccpl['kind']!="segment" OR $noccpl['kind']!="Pattern"){
                 $new_nocspl->lmscpls()->syncWithoutDetaching([$cpl->id]);
                }

        }*/

        $response = array("status" => "saved");
        echo json_encode($response);

    }

    public function updatelocalspl(Request $request)
    {

        $localspl = Nocspl::where('uuid', $request->uuid)->first() ;
        $uuid =   (string)Str::uuid();
        $IssueDate = Carbon::now();

        $file = $this->generateSplXml($uuid, $request->title_spl, $request->hfr, $request->display_mode, $request->items_spl, $IssueDate, 'add') ;

        $file_name = "xml_file_$uuid.xml" ;
        $file_url = Storage::disk('local')->put( $file_name, $file) ;
        $duration = $this->calculateSplDuration(simplexml_load_string($file));
        $new_nocspl = Nocspl::create([
            'uuid' => $uuid ,
            'spl_title' => $request->title_spl,
            'display_mode'=>$request->display_mode,
            'spl_properties_hfr'=>$request ,
            'xmlpath'=>$file_name,
            'duration'=> $duration,
            'location_id'=> null,

        ]) ;

        $response = array("status" => "saved");
        echo json_encode($response);
    }
    public function openlocalspl(Request $request)
    {
            $spl_data = Nocspl::where('uuid',$_GET["id_spl"])->first() ;
            $path =  storage_path().'/app/xml_file/'.$spl_data->xmlpath ;
            $spl_file = simplexml_load_file($path);

            if (property_exists($spl_file, 'EventList')) {
                foreach ($spl_file->EventList->Event as $event) {
                    if (isset($event->ElementList->AutomationCue)) {
                        $automationCues = $event->ElementList->AutomationCue;
                        $ElementList = $event->ElementList;
                        for ($i = 0; $i < count($automationCues); $i++) {
                            $offset = $automationCues[$i]->Offset;
                            $kind = (string)$offset->attributes()->Kind;
                            $event->ElementList->AutomationCue[$i]->addChild('Kind', $kind);
                        }
                    }
                    if (isset($event->ElementList->Marker)) {
                        $Markers = $event->ElementList->Marker;
                        $ElementList = $event->ElementList;
                        for ($i = 0; $i < count($Markers); $i++) {
                            $offset = $Markers[$i]->Offset;
                            $kind = (string)$offset->attributes()->Kind;
                            $event->ElementList->Marker[$i]->addChild('Kind', $kind);
                        }
                    }

                }
            }
            elseif (property_exists($spl_file, 'PackList')) {

                foreach ($spl_file->PackList->Pack as $pack) {
                    foreach ($pack->EventList->Event as $event) {
                        if (isset($event->ElementList->AutomationCue)) {
                            $automationCues = $event->ElementList->AutomationCue;
                            $ElementList = $event->ElementList;
                            for ($i = 0; $i < count($automationCues); $i++) {
                                $offset = $automationCues[$i]->Offset;
                                $kind = (string)$offset->attributes()->Kind;
                                $event->ElementList->AutomationCue[$i]->addChild('Kind', $kind);
                            }
                        }
                        if (isset($event->ElementList->Marker)) {
                            $Markers = $event->ElementList->Marker;
                            $ElementList = $event->ElementList;
                            for ($i = 0; $i < count($Markers); $i++) {
                                $offset = $Markers[$i]->Offset;
                                $kind = (string)$offset->attributes()->Kind;
                                $event->ElementList->Marker[$i]->addChild('Kind', $kind);
                            }
                        }
                    }
                }

            }

            $capabilities = array();
            if (property_exists($spl_file, 'PlaybackEnvironment')) {
                $playbackEnvironment = $spl_file->PlaybackEnvironment;

                if (is_array($playbackEnvironment->EnvironmentCapability)) {
                    // Multiple capabilities
                    $i = 1;

                    foreach ($playbackEnvironment->EnvironmentCapability as $capability) {

                        $capabilities["capability" . $i] = $capability->Capability;
                        $i++;
                    }
                } elseif (is_object($playbackEnvironment->EnvironmentCapability)) {
                    // Multiple capabilities

                    $i = 1;

                    foreach ($playbackEnvironment->EnvironmentCapability as $capability) {

                        $capabilities["capability" . $i] = $capability->Capability;
                        $i++;
                    }
                } elseif (is_object($playbackEnvironment->EnvironmentCapability)) {
                    // Single capability
                    $capabilities["capability1"] = $playbackEnvironment->EnvironmentCapability->Capability;
                }
            }

            $response = array("spl_file" => $spl_file, "capabilities" => $capabilities);

            $json_data = json_encode($response);
            // echo $json_data;
            echo $json_data;
            // $playlist_builder_manager->getPlayList($_POST["id_spl"]);

    }
    public function delete_nocspl(Request $request)
    {
        $spl_data = Nocspl::where('uuid',$_GET["spl_uuid"])->first() ;
        $path =  storage_path().'/app/xml_file/'.$spl_data->xmlpath ;
        File::delete($path);
        if($spl_data->delete())
        {
            $response = array("status" => "success");
            echo json_encode($response);
        }
        else
        {
            $response = array("status" => "failed");
            echo json_encode($response);
        }


    }




    public function uniqueMultidimArray($array, $key): array
    {
        $uniq_array = array();
        $dup_array = array();
        $key_array = array();
        if (!empty($array)) {
            foreach ($array as $val) {
                if (!in_array($val[$key], $key_array)) {
                    $key_array[] = $val[$key];
                    $uniq_array[] = $val;
                    /*
                                # 1st list to check:
                                # echo "ID or sth: " . $val['building_id'] . "; Something else: " . $val['nodes_name'] . (...) "\n";
                    */
                } else {
                    $dup_array[] = $val;
                    /*
                                # 2nd list to check:
                                # echo "ID or sth: " . $val['building_id'] . "; Something else: " . $val['nodes_name'] . (...) "\n";
                    */
                }
            }
        }


        // return array($uniq_array, $dup_array, /* $key_array */);
        return $uniq_array;
    }

    public function generateUuid()
    {
        $data = openssl_random_pseudo_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0F | 0x40); // Set version (4 bits)
        $data[8] = chr(ord($data[8]) & 0x3F | 0x80); // Set bits 6-7 to 10

        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        return 'urn:uuid:' . $uuid;
    }

    public function convertStringToSeconds($timeString)
    {

        $timeString = str_replace(' ', '', $timeString); // Remove spaces from the time string
        $timeInSeconds = strtotime($timeString) - strtotime('TODAY');
        $timeInSecondsFormatted = date('H:i:s', $timeInSeconds);

        //echo $timeInSecondsFormatted; // Output: 00:03:03
        return $timeInSeconds; // Output: 183

    }

     public function generateSplXml($uuid, $ShowTitleText, $HFR, $display_mode, $array_cpl, $IssueDate, $action)
    {


        $file = '<?xml version="1.0" encoding="UTF-8" ?>
                <ShowPlaylist xmlns:spl="http://doremilabs.com/schemas/1.0/SPL" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                    <Id>' . $uuid . '</Id>
                    <ShowTitleText>' . $ShowTitleText . '</ShowTitleText>
                    <AnnotationText>' . $ShowTitleText . '</AnnotationText>
                    <IssueDate>' . $IssueDate . '</IssueDate>
                    <Creator>Expersys TMS</Creator>
                    <TriggerCueList/> ';
        // Check if the conditions are met to include the PlaybackEnvironment section
        if ($HFR == 1 || $display_mode == "3D" || $display_mode == "4k") {
            $file .= '<PlaybackEnvironment>';
            // Include the relevant EnvironmentCapability sections based on the conditions
            if ($HFR == 1) {
                $file .= '<EnvironmentCapability><Capability>HFR_CONTENT</Capability></EnvironmentCapability>';
            }

            if ($display_mode == "3D") {
                $file .= '<EnvironmentCapability><Capability>STEREOSCOPIC_CONTENT</Capability></EnvironmentCapability>';
            } elseif ($display_mode == "4k") {
                $file .= '<EnvironmentCapability><Capability>4K_CONTENT</Capability></EnvironmentCapability>';
            }

            $file .= '</PlaybackEnvironment>';
        }

        $file .= '<PackList>' .
            $this->generatePacks($array_cpl) .
            '</PackList>
</ShowPlaylist>';


        return $file;
    }

    public function updateGeneratedSplXml($uuid, $ShowTitleText, $HFR, $display_mode, $array_cpl, $IssueDate, $action)
    {


        $file = '<?xml version="1.0" encoding="UTF-8" ?>
                <ShowPlaylist xmlns:spl="http://doremilabs.com/schemas/1.0/SPL" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                    <Id>' . $uuid . '</Id>
                    <ShowTitleText>' . $ShowTitleText . '</ShowTitleText>
                    <AnnotationText>' . $ShowTitleText . '</AnnotationText>
                    <IssueDate>' . $IssueDate . '</IssueDate>
                    <Creator>TMS</Creator>
                    <TriggerCueList/> ';
        // Check if the conditions are met to include the PlaybackEnvironment section
        if ($HFR == 1 || $display_mode == "3D" || $display_mode == "4k") {
            $file .= '<PlaybackEnvironment>';
            // Include the relevant EnvironmentCapability sections based on the conditions
            if ($HFR == 1) {
                $file .= '<EnvironmentCapability><Capability>HFR_CONTENT</Capability></EnvironmentCapability>';
            }

            if ($display_mode == "3D") {
                $file .= '<EnvironmentCapability><Capability>STEREOSCOPIC_CONTENT</Capability></EnvironmentCapability>';
            } elseif ($display_mode == "4k") {
                $file .= '<EnvironmentCapability><Capability>4K_CONTENT</Capability></EnvironmentCapability>';
            }

            $file .= '</PlaybackEnvironment>';
        }
        $file .= '<PackList>' .
            $this->updateGeneratePacks($array_cpl) .
            '</PackList>
        </ShowPlaylist>';


        return $file;
    }

    public function updateGeneratePacks($array_cpl)
    {
        // print_r($array_cpl);
        $packs = "";
        $keys = array_keys($array_cpl);
        $duration = 0;
        for ($i = 0; $i < count($array_cpl); $i++) {
            $previous_position = $i - 1;
            $next_position = $i + 1;
            if ($array_cpl[$i]['kind'] == "segment") {
                $packs = $packs .
                    '<Pack>
                      <Id>' . $array_cpl[$i]['uuid'] . '</Id>
                      <PackName>' . htmlspecialchars($array_cpl[$i]['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</PackName>
                      <AnnotationText>' . htmlspecialchars($array_cpl[$i]['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</AnnotationText>
                      <EventList/>
                    </Pack>';
            } else if ($array_cpl[$i]['kind'] == "SPL") {
                $packs = $packs .
                    '<ExternalPack>
                             <Id>' . $array_cpl[$i]['id'] . '</Id>
                             <PackName>' . htmlspecialchars($array_cpl[$i]['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</PackName>
                             <AnnotationText>' . htmlspecialchars($array_cpl[$i]['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</AnnotationText>
                             <External refid="ShowPlaylistId">' . $array_cpl[$i]['uuid'] . '</External>
                        </ExternalPack>';
            } else {
                if ($array_cpl[$i]['items_intermission'] != null) {
                    $intermissions = $array_cpl[$i]['items_intermission'];
                    for ($j = 0; $j < count($intermissions); $j++) {
                        $packs = $packs .
                            '<Pack>
                                <Id>' . $array_cpl[$i] ['id'] . '</Id>
                                <Intermission/>
                                  <EventList>
                                    <Event>
                                       <Id>' . $array_cpl[$i] ['id'] . '</Id>
                                       <ElementList>
                                       <MainElement>
                                          <Composition>
                                             <Id>' . $array_cpl[$i]['id'] . '</Id>
                                             <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                                             <AnnotationText>' . htmlspecialchars($array_cpl[$i]['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</AnnotationText>
                                             <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                                             <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                                          </Composition>
                                       </MainElement>' .
                            '          </ElementList>
                                    </Event>
                                 </EventList>
                             </Pack>' .
                            '<ExternalPack>
                               <Id>' . $intermissions[$j]['uuid'] . '</Id>
                               <Intermission/>
                               <External refid="ShowPlaylistId">' . $intermissions[$j]['uuid'] . '</External>
                             </ExternalPack>';
                    }
                    $packs = $packs .
                        '<Pack>
                           <Id>' . $array_cpl[$i] ['id'] . '</Id>
                            <Intermission/>
                           <EventList>
                             <Event>
                                 <Id>' . $array_cpl[$i] ['id'] . '</Id>
                                 <ElementList>
                                   <MainElement>
                                      <Composition>
                                          <Id>' . $array_cpl[$i]['id'] . '</Id>
                                          <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                                          <AnnotationText>' . htmlspecialchars($array_cpl[$i]['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</AnnotationText>
                                          <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                                         <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                                      </Composition>
                                   </MainElement>' .
                        ($array_cpl[$i]['marker_list'] != null ?
                            implode('', array_map(function ($marker) {
                                return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                            }, $array_cpl[$i]['marker_list']))
                            : ''
                        ) .
                        ($array_cpl[$i]['macro_list'] != null ?
                            implode('', array_map(function ($macro) {
                                return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                            }, $array_cpl[$i]['macro_list']))
                            : ''
                        ) .
                        '          </ElementList>
                                 </Event>
                               </EventList>
                             </Pack>';
                } else {
                    $duration = $duration + $array_cpl[$i]['time_seconds'];
                    if ($i == 0) {
                        $packs = $packs .
                            '<Pack>
                           <Id>' . $this->generateUuid() . '</Id>
                           <PackName/>
                           <AnnotationText/>
                           <EventList>
                             <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                            ($array_cpl[$i]['kind'] == "Pattern" ? $this->updateGeneratedPattern($array_cpl[$i]) : $this->updateGeneratedComposition($array_cpl[$i]))
                            //                                      .'<Composition>
                            //                                          <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
                            //                                          <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                            //                                          <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                            //                                          <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                            //                                         <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                            //                                      </Composition>
                            . '</MainElement>' .
                            ($array_cpl[$i]['marker_list'] != null ?
                                implode('', array_map(function ($marker) {
                                    return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                                }, $array_cpl[$i]['marker_list']))
                                : ''
                            ) .
                            ($array_cpl[$i]['macro_list'] != null ?
                                implode('', array_map(function ($macro) {
                                    return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                }, $array_cpl[$i]['macro_list']))
                                : ''
                            ) .
                            '     </ElementList>
                             </Event>'
                            . (
                            ($i == (count($array_cpl) - 1)) ? "</EventList></Pack>"
                                ? ($i < (count($array_cpl) - 1) and ($array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment"))
                                : "</EventList></Pack>"
                                : "");
                    } else {
                        if ($array_cpl[$previous_position]['kind'] == "SPL" or $array_cpl[$previous_position]['kind'] == "segment" or ($array_cpl[$previous_position]['items_intermission'] != null)) {
                            $packs = $packs .
                                '<Pack>
                           <Id>' . $this->generateUuid() . '</Id>
                           <PackName/>
                           <AnnotationText/>
                           <EventList>
                             <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                                ($array_cpl[$i]['kind'] == "Pattern" ? $this->updateGeneratedPattern($array_cpl[$i]) : $this->updateGeneratedComposition($array_cpl[$i]))
                            //                                      <Composition>
                            //                                          <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
                            //                                          <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                            //                                          <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                            //                                          <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                            //                                         <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                            //                                      </Composition>
                                . '</MainElement>' .
                                ($array_cpl[$i]['marker_list'] != null ?
                                    implode('', array_map(function ($marker) {
                                        return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                                    }, $array_cpl[$i]['marker_list']))
                                    : ''
                                ) .
                                ($array_cpl[$i]['macro_list'] != null ?
                                    implode('', array_map(function ($macro) {
                                        return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                    }, $array_cpl[$i]['macro_list']))
                                    : ''
                                ) .
                                '     </ElementList>
                             </Event>'
                                . (
                                ($i == (count($array_cpl) - 1) or $array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment") ? "</EventList></Pack>"

                                    : ""
                                );
                        } else if ($array_cpl[$previous_position]['kind'] != "SPL" and $array_cpl[$previous_position]['kind'] != "segment") {
                            $packs = $packs .
                                '  <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                                ($array_cpl[$i]['kind'] == "Pattern" ? $this->updateGeneratedPattern($array_cpl[$i]) : $this->updateGeneratedComposition($array_cpl[$i]))

                            //                                   .'   <Composition>
                            //                                          <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
                            //                                          <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                            //                                          <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                            //                                          <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                            //                                         <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                            //                                      </Composition>
                                . '   </MainElement>' .
                                ($array_cpl[$i]['marker_list'] != null ?
                                    implode('', array_map(function ($marker) {
                                        return '<Marker>
                                                <Id>' . $marker['uuid'] . '</Id>
                                                <Label>' . $marker['title'] . '</Label>
                                                <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                            </Marker>';
                                    }, $array_cpl[$i]['marker_list']))
                                    : ''
                                ) .
                                ($array_cpl[$i]['macro_list'] != null ?
                                    implode('', array_map(function ($macro) {
                                        return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                    }, $array_cpl[$i]['macro_list']))
                                    : ''
                                ) .
                                '     </ElementList>
                             </Event>'
                                . (
                                ($i == (count($array_cpl) - 1) or $array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment") ? "</EventList></Pack>"
                                    : ""
                                );

                        }
                    }
                }
            }
        }
        return $packs;
    }

     public function generatePacks($array_cpl)
    {
        // print_r($array_cpl);
        $packs = "";
        $keys = array_keys($array_cpl);
        $duration = 0;
        if (count($array_cpl) == 1) {
            $packs = $packs .
                '<Pack>
                           <Id>' . $this->generateUuid() . '</Id>
                           <PackName/>
                           <AnnotationText/>
                           <EventList>
                             <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                ($array_cpl[0]['kind'] == "Pattern" ? $this->generatePattern($array_cpl[0]) : $this->generateComposition($array_cpl[0]))

                . '</MainElement>' .
                ($array_cpl[0]['marker_list'] != null ?
                    implode('', array_map(function ($marker) {
                        return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                    }, $array_cpl[0]['marker_list']))
                    : ''
                ) .
                ($array_cpl[0]['macro_list'] != null ?
                    implode('', array_map(function ($macro) {
                        return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                    }, $array_cpl[0]['macro_list']))
                    : ''
                ) .
                '     </ElementList>
                             </Event>
                             </EventList></Pack>';

        } else {
            for ($i = 0; $i < count($array_cpl); $i++) {
                $previous_position = $i - 1;
                $next_position = $i + 1;
                if ($array_cpl[$i]['kind'] == "segment") {
                    $packs = $packs .
                        '<Pack>
                      <Id>' . $array_cpl[$i]['uuid'] . '</Id>
                      <PackName>' . $array_cpl[$i]['title'] . '</PackName>
                      <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                      <EventList/>
                    </Pack>';
                } else if ($array_cpl[$i]['kind'] == "SPL") {
                    $packs = $packs .
                        '<ExternalPack>
                             <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
                             <PackName>' . $array_cpl[$i]['title'] . '</PackName>
                             <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                             <External refid="ShowPlaylistId">' . $array_cpl[$i]['uuid'] . '</External>
                        </ExternalPack>';
                } else {

                    if ($array_cpl[$i]['items_intermission'] != null) {
                        $intermissions = $array_cpl[$i]['items_intermission'];
                        for ($j = 0; $j < count($intermissions); $j++) {
                            $packs = $packs .
                                '<Pack>
                                <Id>urn:uuid:' . $array_cpl[$i] ['id'] . '</Id>
                                <Intermission/>
                                  <EventList>
                                    <Event>
                                       <Id>urn:uuid:' . $array_cpl[$i] ['id'] . '</Id>
                                       <ElementList>
                                       <MainElement>
                                          <Composition>
                                             <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
                                             <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                                             <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                                             <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                                             <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                                          </Composition>
                                       </MainElement>' .
                                '          </ElementList>
                                    </Event>
                                 </EventList>
                             </Pack>' .
                                '<ExternalPack>
                               <Id>' . $intermissions[$j]['uuid'] . '</Id>
                               <Intermission/>
                               <External refid="ShowPlaylistId">' . $intermissions[$j]['uuid'] . '</External>
                             </ExternalPack>';
                        }
                        $packs = $packs .
                            '<Pack>
                           <Id>urn:uuid:' . $array_cpl[$i] ['id'] . '</Id>
                            <Intermission/>
                           <EventList>
                             <Event>
                                 <Id>urn:uuid:' . $array_cpl[$i] ['id'] . '</Id>
                                 <ElementList>
                                   <MainElement>
                                      <Composition>
                                          <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
                                          <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
                                          <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
                                          <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
                                         <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
                                      </Composition>
                                   </MainElement>' .
                            ($array_cpl[$i]['marker_list'] != null ?
                                implode('', array_map(function ($marker) {
                                    return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                                }, $array_cpl[$i]['marker_list']))
                                : ''
                            ) .
                            ($array_cpl[$i]['macro_list'] != null ?
                                implode('', array_map(function ($macro) {
                                    return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                }, $array_cpl[$i]['macro_list']))
                                : ''
                            ) .
                            '          </ElementList>
                                 </Event>
                               </EventList>
                             </Pack>';
                    } else {
                        $duration = $duration + $array_cpl[$i]['time_seconds'];
                        if ($i == 0) {
                            $packs = $packs .
                                '<Pack>
                           <Id>' . $this->generateUuid() . '</Id>
                           <PackName/>
                           <AnnotationText/>
                           <EventList>
                             <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                                ($array_cpl[$i]['kind'] == "Pattern" ? $this->generatePattern($array_cpl[$i]) : $this->generateComposition($array_cpl[$i]))

                                . '</MainElement>' .
                                ($array_cpl[$i]['marker_list'] != null ?
                                    implode('', array_map(function ($marker) {
                                        return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                                    }, $array_cpl[$i]['marker_list']))
                                    : ''
                                ) .
                                ($array_cpl[$i]['macro_list'] != null ?
                                    implode('', array_map(function ($macro) {
                                        return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                    }, $array_cpl[$i]['macro_list']))
                                    : ''
                                ) .
                                '     </ElementList>
                             </Event>';
                            if ($i == (count($array_cpl) - 1)) {
                                $packs .= $packs . "</EventList></Pack>";
                            } else if (($i < (count($array_cpl) - 1) and ($array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment"))) {
                                $packs .= $packs . "</EventList></Pack>";
                            }
//                            . (
//                            ($i == (count($array_cpl) - 1)) ? "</EventList></Pack>"
//                                ? ($i < (count($array_cpl) - 1) and ($array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment"))
//                                : "</EventList></Pack>"
//                                : "");
                        } else {

                            if ($array_cpl[$previous_position]['kind'] == "SPL" or $array_cpl[$previous_position]['kind'] == "segment" or ($array_cpl[$previous_position]['items_intermission'] != null)) {
                                $packs = $packs .
                                    '<Pack>
                           <Id>' . $this->generateUuid() . '</Id>
                           <PackName/>
                           <AnnotationText/>
                           <EventList>
                             <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                                    ($array_cpl[$i]['kind'] == "Pattern" ? $this->generatePattern($array_cpl[$i]) : $this->generateComposition($array_cpl[$i]))

                                    . '</MainElement>' .
                                    ($array_cpl[$i]['marker_list'] != null ?
                                        implode('', array_map(function ($marker) {
                                            return '   <Marker>
                                         <Id>' . $marker['uuid'] . '</Id>
                                         <Label>' . $marker['title'] . '</Label>
                                         <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                       </Marker>';
                                        }, $array_cpl[$i]['marker_list']))
                                        : ''
                                    ) .
                                    ($array_cpl[$i]['macro_list'] != null ?
                                        implode('', array_map(function ($macro) {
                                            return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                        }, $array_cpl[$i]['macro_list']))
                                        : ''
                                    ) .
                                    '     </ElementList>
                             </Event>'
                                    . (
                                    ($i == (count($array_cpl) - 1) or $array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment") ? "</EventList></Pack>"

                                        : ""
                                    );
                            } else if ($array_cpl[$previous_position]['kind'] != "SPL" and $array_cpl[$previous_position]['kind'] != "segment") {
                                $packs = $packs .
                                    '  <Event>
                                 <Id>' . $this->generateUuid() . '</Id>
                                 <ElementList>
                                   <MainElement>' .
                                    ($array_cpl[$i]['kind'] == "Pattern" ? $this->generatePattern($array_cpl[$i]) : $this->generateComposition($array_cpl[$i]))

//                                   .'   <Composition>
//                                          <Id>urn:uuid:' . $array_cpl[$i]['id'] . '</Id>
//                                          <CompositionPlaylistId>' . $array_cpl[$i]['uuid'] . '</CompositionPlaylistId>
//                                          <AnnotationText>' . $array_cpl[$i]['title'] . '</AnnotationText>
//                                          <IntrinsicDuration>' . $array_cpl[$i]['time_seconds'] * $array_cpl[$i]['editrate_numerator'] . '</IntrinsicDuration>
//                                         <EditRate>' . $array_cpl[$i]['editrate_numerator'] . ' ' . $array_cpl[$i]['editrate_denominator'] . '</EditRate>
//                                      </Composition>
                                    . '   </MainElement>' .
                                    ($array_cpl[$i]['marker_list'] != null ?
                                        implode('', array_map(function ($marker) {
                                            return '<Marker>
                                                <Id>' . $marker['uuid'] . '</Id>
                                                <Label>' . $marker['title'] . '</Label>
                                                <Offset Kind="' . $marker['offset'] . '">' . $marker['time_frames'] . '</Offset>
                                            </Marker>';
                                        }, $array_cpl[$i]['marker_list']))
                                        : ''
                                    ) .
                                    ($array_cpl[$i]['macro_list'] != null ?
                                        implode('', array_map(function ($macro) {
                                            return '   <AutomationCue>
                                         <Id>' . $macro['uuid'] . '</Id>
                                         <Action>' . $macro['title'] . '</Action>
                                         <Offset Kind="' . $macro['offset'] . '">' . $macro['time_frames'] . '</Offset>
                                       </AutomationCue>';
                                        }, $array_cpl[$i]['macro_list']))
                                        : ''
                                    ) .
                                    '     </ElementList>
                             </Event>'
                                    . (
                                    ($i == (count($array_cpl) - 1) or $array_cpl[$next_position]["kind"] == "SPL" or $array_cpl[$next_position]["kind"] == "segment") ? "</EventList></Pack>"
                                        : ""
                                    );

                            }
                        }
                    }
                }
            }
        }

        return $packs;
    }

    public function generateComposition($cpl_item)
    {
        $composition = ' <Composition>
                        <Id>' . $cpl_item['id'] . '</Id>
                        <CompositionPlaylistId>' . $cpl_item['uuid'] . '</CompositionPlaylistId>
                        <AnnotationText>' . htmlspecialchars($cpl_item['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</AnnotationText>
                        <IntrinsicDuration>' . $cpl_item['time_seconds'] * $cpl_item['editrate_numerator'] / $cpl_item['editrate_denominator'] . '</IntrinsicDuration>
                        <EditRate>' . $cpl_item['editrate_numerator'] . ' ' . $cpl_item['editrate_denominator'] . '</EditRate>
                        </Composition>';
        return $composition;
    }

    public function updateGeneratedComposition($cpl_item)
    {
        $composition = ' <Composition>
                        <Id>' . $cpl_item['id'] . '</Id>
                        <CompositionPlaylistId>' . $cpl_item['uuid'] . '</CompositionPlaylistId>
                        <AnnotationText>' . htmlspecialchars($cpl_item['title'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</AnnotationText>
                        <IntrinsicDuration>' . $cpl_item['time_seconds'] * $cpl_item['editrate_numerator'] / $cpl_item['editrate_denominator'] . '</IntrinsicDuration>
                        <EditRate>' . $cpl_item['editrate_numerator'] . ' ' . $cpl_item['editrate_denominator'] . '</EditRate>
                        </Composition>';
        return $composition;
    }

    public function generatePattern($cpl_item)
    {
        $pattern = ' <Pattern>

                        <Id>' . $cpl_item['uuid'] . '</Id>
                        <AnnotationText>' . $cpl_item['title'] . '</AnnotationText>
                        <Duration>' . $cpl_item['time_seconds'] * $cpl_item['editrate_numerator'] / $cpl_item['editrate_denominator'] . '</Duration>
                        <EditRate>' . $cpl_item['editrate_numerator'] . ' ' . $cpl_item['editrate_denominator'] . '</EditRate>
                        <FrameRate>' . $cpl_item['editrate_numerator'] . ' ' . $cpl_item['editrate_denominator'] . '</FrameRate>
                        </Pattern>';

        return $pattern;
    }

    public function updateGeneratedPattern($cpl_item)
    {
        $pattern = ' <Pattern>

                        <Id>' . $cpl_item['uuid'] . '</Id>
                        <AnnotationText>' . $cpl_item['title'] . '</AnnotationText>
                        <Duration>' . $cpl_item['time_seconds'] * $cpl_item['editrate_numerator'] / $cpl_item['editrate_denominator'] . '</Duration>
                        <EditRate>' . $cpl_item['editrate_numerator'] . ' ' . $cpl_item['editrate_denominator'] . '</EditRate>
                        <FrameRate>' . $cpl_item['editrate_numerator'] . ' ' . $cpl_item['editrate_denominator'] . '</FrameRate>
                        </Pattern>';

        return $pattern;
    }

    public function calculateSplDuration($simpleXml)
    {


        $totalDuration = 0;

        // Iterate over the <Pack> elements
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

        return $totalDuration;
    }


    public function get_nocspl()
    {
        $nocspls = Nocspl::all() ;
        $locations =Location::all() ;
        return Response()->json(compact('nocspls','locations'));
    }



    public function sendXmlFileToApi(Request $request)
    {
        // Check if the file exists
        $xmlFilePath =    storage_path().'/app/xml_file/'.$request->path ;
        if (!file_exists($xmlFilePath)) {
            return ['error' => 'File not found.'];
        }
        // Read XML content from the file
        $xmlData = file_get_contents($xmlFilePath);

        // Initialize cURL session
        $ch = curl_init($request->apiUrl);

        // Set cURL options
        $postData = [
            'xmlData' => $xmlData
        ];


        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        //print_r($response);
        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Curl error: ' . curl_error($ch)];
        }

        // Close cURL session
        curl_close($ch);


        // Process the API response
        if ($response == 0 ) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            // Assuming the API returns JSON response
            return json_decode($response, true);
        }
    }

    public function checkAvailability(Request $request)
    {
        $spl_title = $request->spl_title ;
        $nos_spls = Nocspl::where('spl_title' ,$spl_title)->get() ;

        if(count($nos_spls)>0)
        {
            echo "taken" ;
        }
        else
        {
            echo "not_taken" ;
        }
    }

    public function checkCplsInLocation(Request $request)
    {
        $location = $request->ingest_location ;
        $nos_spl_uuid = $request->uuid ;
        $nocspl = Nocspl::where('uuid', $nos_spl_uuid)->first() ;
        $cpls = $nocspl->lmscpls ;

        //$cpls_location_id = array_column($cpls, 'location_id');
        foreach($cpls as $cpl)
        {
            if ($cpl != $location)
            {
                return ['checkcplsinlocation' => 'There are CPLs that do not exist in this location.'];
            }
        }
        return ['checkcplsinlocation' => 'All CPls exist in this location.'];

    }

    public function uploadlocalspl(Request $request)
    {
        try {

            foreach ($request->splfiles as $splfiles )
            {
                $spl_file_content = simplexml_load_file($splfiles);
                $file_name = "$spl_file_content->Id.xml" ;
                $file_url = Storage::disk('local')->put( $file_name, $splfiles) ;
                $duration = $this->calculateSplDuration($spl_file_content);
                $new_nocspl = Nocspl::create([
                    'uuid' => $spl_file_content->Id ,
                    'spl_title' => $spl_file_content->ShowTitleText,
                    'display_mode'=>null,
                    'spl_properties_hfr'=>null ,
                    'xmlpath'=>$file_name,
                    'duration'=> $duration,
                    'source'=> "flash disk",
                    'location_id'=> null,
                ]) ;
            }
            echo "Success" ;

        } catch (Exception $e) {
            echo "Failed" ;
            return $e;
        }

    }
}
