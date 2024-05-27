<?php

namespace App\Http\Controllers;

use App\Events\changeDataEvent;
use App\Http\Requests\LocationStoreRequest;
use App\Models\Cpl;
use App\Models\Dcp_trensfer;
use App\Models\Lmscpl;
use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Power;
use App\Models\Screen;
use App\Models\Spl;
use App\Models\splcomponents;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

ini_set('max_execution_time', 600);

class LocationController extends Controller
{
    public function index(Request $request): View
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }
       // broadcast(new changeDataEvent($location))->toOthers() ;
        return view('locations.index', compact('locations'));
    }

    public function create(): View
    {
        if( Auth::user()->role == 1)
        {
            return view('locations.create');
        }
        else
        {
            abort(403) ;
        }
    }

    public function show(Location $location): View
    {
        return view('locations.show', compact('location'));
    }

    public function store(LocationStoreRequest $request)
    {

        $location = Location::create($request->validated());
        return redirect()->route('location.index')->with('message' ,' The location has been created ');
    }

    public function edit(Location $location): View
    {
        return view('locations.edit',compact('location') );
    }

    public function update (Location $location , LocationStoreRequest $request )
    {
        $location->update($request->validated());
        return redirect()->route('location.index')->with('message' ,' The location has been updated  ');
    }

    public function location_infos($location )
    {
        $location = Location::find($location) ;
        $diskusage = $location->diskusage ;
        return Response()->json(compact('location','diskusage'));
    }

    public function refresh_all_data()
    {
        $locations = Location::all() ;
        // get all screen
        foreach($locations as $location)
        {
            $this->getscreens($location->id);
            echo "screens of location $location->name imported <br />" ;
        }

        echo "screen imported <br />" ;

        foreach($locations as $location)
        {
            foreach($location->screens as $screen)
            {
                echo "Screen : " . $screen->screen_name ."<br />";
                app(\App\Http\Controllers\SplController::class)->getspls($location->id,$screen->id);
            }
            echo "spls of location $location->name imported <br />" ;
        }
        echo "All spls imported<br />" ;

        // get all cpls
        foreach($locations as $location)
        {
            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
            }
            echo "cpls of location $location->name imported <br />" ;
        }
        echo "All cpls imported<br />" ;

         //sync cpls with spls
        foreach($locations as $location)
        {
            $this->sync_spl_cpl($location->id );
        }
        echo "SPls and CPLs sync" ;

        // get all KDMs
        echo "<br />------------------------<br />" ;
        echo "Start import  KDMs  <br />" ;
        foreach($locations as $location)
        {

            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
            }


        }
        echo "All KDMs imported<br />" ;

    }

    public function refresh_all_data_of_location( $location)
    {
        $location = Location::find($location);
        echo "Start Import screen<br />" ;
        $this->getscreens($location->id);
        echo "screens of location $location->name imported <br />" ;

        echo "<br />------------------------<br />" ;

        echo "Start Import Spls <br />" ;
            $location = Location::find($location);
            foreach($location->screens as $screen)
            {
                echo "Screen : " . $screen->screen_name ."<br />";
                app(\App\Http\Controllers\SplController::class)->getspls($location->id,$screen->id);
            }
            echo "spls of location $location->name imported <br />" ;

        echo "All spls imported<br />" ;

        // get all cpls
        echo "<br />------------------------<br />" ;

        echo "Start Import CPLs <br />" ;
        $location = Location::find($location);
        foreach($location->screens as $screen)
        {
            app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
        }
        echo "cpls of location $location->name imported <br />" ;

        echo "All cpls imported<br />" ;

         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "Start Sync SPLs and CPLs   <br />" ;
            $location = Location::find($location);
            $this->sync_spl_cpl($location->id );

        echo "All SPls and CPLs sync" ;


        // get all KDMs
        echo "<br />------------------------<br />" ;
        echo "Start import  KDMs  <br />" ;
        $location = Location::find($location);
        foreach($location->screens as $screen)
        {
            app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
        }
        echo "All KDMs imported<br />" ;

        echo "<br />------------------------<br />" ;
        echo "Start import  schedules  <br />" ;
        $location = Location::find($location);


        foreach($location->spls as $spls)
        {
            app(\App\Http\Controllers\ScheduleContoller::class)->getschedules($location->id,$spls->uuid);
        }
        echo "All schedules imported<br />" ;
    }

    public function refresh_content_of_location( $location)
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();

        $location = Location::find($location);

        echo "Start Import Spls <br />" ;
          //  $location = Location::find($location->id);
            foreach($location->screens as $screen)
            {
                echo "Screen : " . $screen->screen_name ." location : $location->id <br />";
                app(\App\Http\Controllers\SplController::class)->getspls($location->id,$screen->id);
            }
            echo "spls of location $location->name imported <br />" ;

        echo "All spls imported<br />" ;
        // get all cpls
        echo "<br />------------------------<br />" ;


        echo "Start Import CPLs <br />" ;

        $location = Location::find($location->id);


        foreach($location->screens as $screen)
        {
            echo "Screen : " . $screen->screen_name ." location : $location->id <br />";
            app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
        }

        echo "cpls of location $location->name imported <br />" ;

        echo "All cpls imported<br />" ;

         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "Start Sync SPLs and CPLs   <br />" ;
           $location = Location::find($location->id);
            $this->sync_spl_cpl($location->id );

        echo "All SPls and CPLs sync" ;


        // get all KDMs
        echo "<br />------------------------<br />" ;
        echo "Start import  KDMs  <br />" ;
        $location = Location::find($location->id);
        foreach($location->screens as $screen)
        {

            app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
        }
        echo "All KDMs imported<br />" ;
    }

    public function refresh_content_all_location( )
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();

        $locations = Location::all() ;
        foreach($locations as $location)
        {
            //  $location = Location::find($location->id);
            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\SplController::class)->getspls($location->id,$screen->id);
            }
            //$location = Location::find($location->id);
            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
            }

            //$location = Location::find($location->id);
            $this->sync_spl_cpl($location->id );
            // get all KDMs

            //$location = Location::find($location->id);
            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
            }


        }
    }

    public function refresh_lms_data_of_location( $location)
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();

        $location = Location::find($location);

        echo "Start Import LMS Spls <br />" ;
            $location = Location::find($location->id);
            app(\App\Http\Controllers\LmssplController::class)->getlmsspls($location->id);
            echo "spls of location $location->name imported <br />" ;

        echo "All LMS spls imported<br />" ;

        // get all LMS cpls
        echo "<br />------------------------<br />" ;

        echo "Start Import LMS CPLs <br />" ;
        $location = Location::find($location->id);
        app(\App\Http\Controllers\LmscplController::class)->getlmscpls($location->id);
        echo "All LMS cpls imported<br />" ;
         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "Start Sync LMS SPLs and CPLs   <br />" ;
            $location = Location::find($location->id);
            $this->sync_lms_spl_cpl($location->id );

        echo "All LMS  SPls and CPLs sync" ;


        echo "<br />------------------------<br />" ;

        echo "Start Import LMS KDMs <br />" ;
        $location = Location::find($location->id);
        app(\App\Http\Controllers\LmskdmController::class)->getlmskdms($location->id);
        echo "All LMS KDMs imported<br />" ;
         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "All LMS KDms imported<br />" ;
    }

    public function refresh_lms_data_all_location()
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {

            app(\App\Http\Controllers\LmssplController::class)->getlmsspls($location->id);
            app(\App\Http\Controllers\LmscplController::class)->getlmscpls($location->id);
            $this->sync_lms_spl_cpl($location->id );
            app(\App\Http\Controllers\LmskdmController::class)->getlmskdms($location->id);
        }
    }


    public function getscreens( $location )
    {
        //$url = "http://localhost/tms_front/system/api2.php?request=get_screens";

        $location = Location::find($location) ;

        //dd($location) ;
        $url = $location->connection_ip . "?request=get_screens";

        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {

            foreach($contents as $content)
            {
                foreach($content as $screen)
                {

                    $new_screen = Screen::updateOrCreate([
                        'screen_number' => $screen["screen_number"],
                        'location_id' => $location->id
                    ],[
                        "id_server"  => $screen["id_server"],
                        "screen_number"  => $screen["screen_number"],
                        "screen_name"  => $screen["screen_name"],
                        "screenModel"  => $screen["screenModel"],
                        "playback"  => $screen["playback"],
                        "sound"  => $screen["sound"],
                        "server_ip"  => $screen["server_ip"],
                        "ingestProtocol_server"  => $screen["ingestProtocol_server"],
                        "remotPath"  => $screen["remotPath"],
                        "managment_ip"  => $screen["managment_ip"],
                        "projector_enable"  => $screen["projector_enable"],
                        "projector_ip"  => $screen["projector_ip"],
                        "projector_brand"  => $screen["projector_brand"],
                        "projector_model"  => $screen["projector_model"],
                        "sound_enable"  => $screen["sound_enable"],
                        "sound_ip"  => $screen["sound_ip"],
                        "sound_brand"  => $screen["sound_brand"],
                        "sound_model"  => $screen["sound_model"],
                        "audio_enable"  => $screen["audio_enable"],
                        "audio_ip"  => $screen["audio_ip"],
                        "audio_brand"  => $screen["audio_brand"],
                        "audio_model"  => $screen["audio_model"],
                        "automation_enable"  => $screen["automation_enable"],
                        "automation_ip"  => $screen["automation_ip"],
                        "automation_brand"  => $screen["automation_brand"],
                        "automation_model"  => $screen["automation_model"],
                        "automation_username"  => $screen["automation_username"],
                        "automation_password"  => $screen["automation_password"],
                        "enable_power_control"  => $screen["enable_power_control"],
                        "serial_number"  => $screen["serial_number"],
                        "jp2k_dnQualifier"  => $screen["jp2k_dnQualifier"],
                        "jp2k_cn"  => $screen["jp2k_cn"],
                        "dolby_audio_processor_dnQualifier"  => $screen["dolby_audio_processor_dnQualifier"],
                        'location_id' => $location->id,
                    ]);


                    foreach($screen['powers'] as $power)
                    {


                        Power::updateOrCreate([
                            'id_power' => $power["id"],
                            'location_id' => $location->id,
                        ],[
                            'location_id' => $location->id,
                            "model"  => $power["model"],
                            "ip"  => $power["ip"],
                            "device_name"  => $power["device_name"],
                            "model"  => $power["model"],
                            "id_server"  => $screen["id_server"],
                            "screen_id" => $new_screen->id ,
                            'id_power' => $power["id"],

                        ]);


                    }
                }
                if(count($content) < $location->screens->count() )
                {
                    $id_servers = array_column($content, 'id_server');

                        foreach($location->screens as $screen)
                        {
                            if (! in_array( $screen->id_server , $id_servers))
                            {
                                // delete deleted screen
                                echo "Screen name : $screen->screen_name has been deleted  " ;
                                $screen->delete() ;
                            }


                        }

                    //dd('we should delete screens ') ;
                }


            }
        }
        return Redirect::back()->with('message' ,' The Screens  has been updated');



    }

    public function refresh_spl_content( $location)
    {
        try
        {
            $location = Location::find($location);
            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\SplController::class)->getspls($location->id,$screen->id);
            }
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));
    }

    public function refresh_lmsspl_content( $location)
    {
        try
        {
            $location = Location::find($location);
            app(\App\Http\Controllers\LmssplController::class)->getlmsspls($location->id);
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;
        }
        return Response()->json(compact('status'));
    }

    public function refresh_cpl_content($location)
    {
        try
        {
            $location = Location::find($location);

            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
            }
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));
    }

    public function refresh_lmscpl_content($location)
    {
        try
        {
            $location = Location::find($location);
            app(\App\Http\Controllers\LmscplController::class)->getlmscpls($location->id);

            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));
    }


    public function refresh_kdm_content($location)
    {
        try
        {
            $location = Location::find($location);
            foreach($location->screens as $screen)
            {
                app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
            }
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));
    }

    public function refresh_lmskdm_content($location)
    {

        try
        {
            $location = Location::find($location);
            app(\App\Http\Controllers\LmskdmController::class)->getlmskdms($location->id);

            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));
    }



    public function refresh_schedule_content($location)
    {
        try
        {
            $location = Location::find($location);
            app(\App\Http\Controllers\ScheduleContoller::class)->getschedules($location->id);
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;
        }
        return Response()->json(compact('status'));
    }

    public function refresh_schedule_all_location()
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\ScheduleContoller::class)->getschedules($location->id);
        }
    }
    public function sync_spl_cpl( $location )
    {
        $location = Location::find($location) ;
        $spls = Spl::where('location_id',$location->id)->groupBy('uuid')->get();
        $lmsspls = $location->lmsspls ;
        splcomponents::where('location_id',$location->id)->delete();

        foreach($spls as $spl)
        {
            $url = $location->connection_ip."?request=getCplsBySpl&spl_uuid=".$spl->uuid;
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);

            if($contents)
            {
                foreach($contents as $content)
                {
                    if($content)
                    {
                        foreach($content as $cpl_content)
                        {
                            splcomponents::Create([
                                'id_splcomponent' => $cpl_content['id'],
                                'CompositionPlaylistId' => $cpl_content['CompositionPlaylistId'],
                                'AnnotationText' => $cpl_content['AnnotationText'],
                                'EditRate' => $cpl_content['EditRate'],
                                'editRate_numerator' => $cpl_content['editRate_numerator'],
                                'editRate_denominator' => $cpl_content['editRate_denominator'],
                                'uuid_spl' => $cpl_content['uuid_spl'],
                                'location_id'     =>$location->id,
                            ]);
                        }
                    }
                }
            }
        }

        /*foreach($lmsspls as $spl)
        {
            $url = $location->connection_ip."?request=getCplsBySpl&spl_uuid=".$spl->uuid;
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);
           // echo $url ."<br />" ;

            if($contents)
            {
                foreach($contents as $content)
                {
                    if($content)
                    {
                        foreach($content as $cpl_content)
                        {

                            splcomponents::updateOrCreate([
                                'uuid_spl' => $cpl_content['uuid_spl'],
                                'CompositionPlaylistId' => $cpl_content['CompositionPlaylistId'],
                            ],[
                                'id_splcomponent' => $cpl_content['id'],
                                'CompositionPlaylistId' => $cpl_content['CompositionPlaylistId'],
                                'AnnotationText' => $cpl_content['AnnotationText'],
                                'EditRate' => $cpl_content['EditRate'],
                                'editRate_numerator' => $cpl_content['editRate_numerator'],
                                'editRate_denominator' => $cpl_content['editRate_denominator'],
                                'uuid_spl' => $cpl_content['uuid_spl'],
                            ]);

                        }
                    }

                }

                $splcomponents = splcomponents::where('uuid_spl',$spl->uuid)->get() ;

                if(count($contents) != count($splcomponents) )
                {
                    $uuid_spls = array_column($content, 'id');
                        foreach($splcomponents as $splcomponent)
                        {
                            if (! in_array( $splcomponent->id_splcomponent , $uuid_spls))
                            {
                                $splcomponent->delete() ;
                            }
                        }
                }


            }


        }*/

    }

    public function sync_lms_spl_cpl( $location )
    {

        dd('');
        $lms_spls = Lmsspl::all() ;
        $location = Location::find($location) ;
        foreach($lms_spls as $lms_spl)
        {
            $url = $location->connection_ip."?request=getCplsBySpl&spl_uuid=".$lms_spl->uuid;
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);
            //$spl->cpls()->detach() ;
            if($contents)
            {
                foreach($contents as $content)
                {
                    if($content)
                    {
                        foreach($content as $cpl_content)
                        {
                            $lms_cpl = Lmscpl::where('uuid','=',$cpl_content['CompositionPlaylistId'])->where('location_id','=',$location->id)->first() ;
                            if($lms_cpl)
                            {
                                $lms_spl->lmscpls()->syncWithoutDetaching([$lms_cpl->id]);
                            }
                            else
                            {
                                //dd($cpl_content) ;
                            }
                        }
                    }
                }
            }

        }
    }

    public function refresh_playback_data()
    {
        try
        {
           // $start_time = Carbon::now();
            //echo $start_time->toDateTimeString();
            $locations = Location::all() ;
            foreach($locations as $location)
            {
                app(\App\Http\Controllers\PlaybackController::class)->getplayback($location->id);
            }
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));
    }

    public function refresh_snmp_data()
    {
        try
        {
            $locations = Location::all() ;
            foreach($locations as $location)
            {
                app(\App\Http\Controllers\SnmpController::class)->getsnmp($location->id);
            }
            $status = 1 ;
        } catch (Exception $e) {
            $status = 0 ;

        }
        return Response()->json(compact('status'));

    }

    public function refresh_macro_data_by_location($location)
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $location = Location::find($location) ;
        app(\App\Http\Controllers\MacroController::class)->getMacros($location->id);
    }

    public function refresh_macro_data()
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\MacroController::class)->getMacros($location->id);
        }

    }

    public function refresh_logs_data()
    {
        dd('');
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\LogController::class)->get_logs($location->id);
        }

    }

    public function refresh_movies_data()
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\MoviescodController::class)->getMoviesCods($location->id);
        }

    }

    public function refresh_asset_infos_data()
    {
        //$start_time = Carbon::now();
        //echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\AssetinfoController::class)->get_asset_infos($location->id);
        }
        return true  ;
    }

    public function refresh_disk_usage_data()
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\DiskusageController::class)->getdiskusage($location->id);
        }

    }

    public function refresh_errors_list_data()
    {
        $start_time = Carbon::now();
        echo $start_time->toDateTimeString();
        $locations = Location::all() ;
        foreach($locations as $location)
        {
            app(\App\Http\Controllers\Error_listController::class)->get_error_list($location->id);
        }

    }

    public function refresh_dcp_trensfer_data()
    {
        $dcps = Dcp_trensfer::where(function ($query) {
                $query->where('dcp_trensfers.status', '=','Pending' )
                    ->orWhere('dcp_trensfers.status', '=', "Running");
                })->get() ;

        foreach($dcps as $dcp)
        {
            $location = Location::find($dcp->location_id) ;
            $url = $location->connection_ip."?request=get_ingest_progress&path_in_tms=".$dcp->torrent_path;
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);


            echo " status ".$contents['status'] ."\n <br />";
            echo " progress API ".$contents['progress'] ."<br />";
            echo " progress DCP ".$dcp->progress."<br />";
            echo " id ".$dcp->id."<br />";
            echo " Path ".$dcp->torrent_path."<br />";

            if($contents['status'])
            {
                if($contents['progress']> 0 )
                {
                    $dcp->update([
                        'status'     =>"Running",
                        "progress" => $contents['progress'] ,
                    ]);
                }
                if($contents['progress'] ==  $dcp->pkl_size )
                {
                    $dcp->update([
                        'status'     =>"Completed",
                        "progress" => $contents['progress'] ,
                    ]);
                }
            }
            else
            {
                $dcp->update([
                    'status'     =>"Failed",
                ]);
            }

        }
    }

    public function destroy(Request $request)
    {
        $location = Location::find($request->location_id) ;
        Power::where('location_id',$location->id)->delete() ;
        if($location->delete())
        {
            $status = 1 ;
        }
        else
        {
            $status = 0 ;
        }
        return Response()->json(compact('status'));

    }

}
