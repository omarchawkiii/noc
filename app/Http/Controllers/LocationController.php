<?php

namespace App\Http\Controllers;

use App\Events\changeDataEvent;
use App\Http\Requests\LocationStoreRequest;
use App\Models\Cpl;
use App\Models\Lmscpl;
use App\Models\Lmsspl;
use App\Models\Location;
use App\Models\Power;
use App\Models\Screen;
use App\Models\Spl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;
ini_set('max_execution_time', 600);

class LocationController extends Controller
{
    public function index(Request $request): View
    {
        $locations = Location::all();
        $location= Location::all()->first();
       // broadcast(new changeDataEvent($location))->toOthers() ;
        return view('locations.index', compact('locations'));
    }

    public function create(): View
    {
        return view('locations.create');
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
        // get all spls
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
        $location = Location::find($location)->first();
        echo "Start Import screen<br />" ;
        $this->getscreens($location);
        echo "screens of location $location->name imported <br />" ;

        echo "<br />------------------------<br />" ;

        echo "Start Import Spls <br />" ;
            $location = Location::find($location->id);
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
        $location = Location::find($location)->first();
        foreach($location->screens as $screen)
        {
            app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
        }
        echo "cpls of location $location->name imported <br />" ;

        echo "All cpls imported<br />" ;

         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "Start Sync SPLs and CPLs   <br />" ;
            $location = Location::find($location)->first();
            $this->sync_spl_cpl($location->id );

        echo "All SPls and CPLs sync" ;


        // get all KDMs
        echo "<br />------------------------<br />" ;
        echo "Start import  KDMs  <br />" ;
        $location = Location::find($location)->first();
        foreach($location->screens as $screen)
        {
            app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
        }
        echo "All KDMs imported<br />" ;

        echo "<br />------------------------<br />" ;
        echo "Start import  schedules  <br />" ;
        $location = Location::find($location)->first();


        foreach($location->spls as $spls)
        {
            app(\App\Http\Controllers\ScheduleContoller::class)->getschedules($location->id,$spls->uuid);
        }
        echo "All schedules imported<br />" ;


    }


    public function refresh_content_of_location( $location)
    {
        $location = Location::find($location)->first();

        echo "Start Import Spls <br />" ;
            $location = Location::find($location->id);
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
        $location = Location::find($location)->first();
        foreach($location->screens as $screen)
        {
            app(\App\Http\Controllers\CplController::class)->getcpls($location->id,$screen->id);
        }
        echo "cpls of location $location->name imported <br />" ;

        echo "All cpls imported<br />" ;

         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "Start Sync SPLs and CPLs   <br />" ;
            $location = Location::find($location)->first();
            $this->sync_spl_cpl($location->id );

        echo "All SPls and CPLs sync" ;


        // get all KDMs
        echo "<br />------------------------<br />" ;
        echo "Start import  KDMs  <br />" ;
        $location = Location::find($location)->first();
        foreach($location->screens as $screen)
        {
            app(\App\Http\Controllers\KdmController::class)->getkdms($location->id,$screen->id);
        }
        echo "All KDMs imported<br />" ;


    }


    public function refresh_lms_data_of_location( $location)
    {
        $location = Location::find($location)->first();

        echo "Start Import LMS Spls <br />" ;
            $location = Location::find($location->id);
            app(\App\Http\Controllers\LmssplController::class)->getlmsspls($location->id);
            echo "spls of location $location->name imported <br />" ;

        echo "All LMS spls imported<br />" ;

        // get all LMS cpls
        echo "<br />------------------------<br />" ;

        echo "Start Import LMS CPLs <br />" ;
        $location = Location::find($location)->first();
        app(\App\Http\Controllers\LmscplController::class)->getlmscpls($location->id);
        echo "All LMS cpls imported<br />" ;
         //sync cpls with spls
         echo "<br />------------------------<br />" ;

         echo "Start Sync LMS SPLs and CPLs   <br />" ;
            $location = Location::find($location)->first();
            $this->sync_lms_spl_cpl($location->id );

        echo "All SPls and CPLs sync" ;


    }


    public function getscreens( $location )
    {
        //$url = "http://localhost/tms_front/system/api2.php?request=get_screens";

        $location = Location::find($location)->first() ;

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
                        'id_server' => $screen["id_server"],
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


    public function sync_spl_cpl( $location )
    {
        $spls = Spl::all() ;

        $location = Location::find($location)->first() ;

        foreach($spls as $spl)
        {
            $url = $location->connection_ip."?request=getCplsBySpl&spl_uuid=".$spl->uuid;
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
                            $cpl = Cpl::where('uuid','=',$cpl_content['CompositionPlaylistId'])->where('location_id','=',$location->id)->first() ;
                            if($cpl)
                            {
                                $spl->cpls()->syncWithoutDetaching([$cpl->id]);
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

    public function sync_lms_spl_cpl( $location )
    {
        $lms_spls = Lmsspl::all() ;

        $location = Location::find($location)->first() ;

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



}
