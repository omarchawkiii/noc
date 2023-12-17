<?php

namespace App\Http\Controllers;

use App\Events\changeDataEvent;
use App\Http\Requests\LocationStoreRequest;
use App\Models\Cpl;
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

    public function getscreens(Location $location )
    {
        //$url = "http://localhost/tms_front/system/api2.php?request=get_screens";

        $url = $location->connection_ip . "?request=get_screens";

        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);


        // Delete All powers befere deleting screens
        if($contents)
        {
            foreach($location->screens as $screen)
            {
                $screen->powers()->delete() ;
            }

            $location->screens()->delete() ;
            foreach($contents as $content)
            {
                foreach($content as $screen)
                {
                    $new_screen = Screen::create([

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

                    ]

                    );


                    foreach($screen['powers'] as $power)
                    {
                        Power::create([
                            "model"  => $power["model"],
                            "ip"  => $power["ip"],
                            "device_name"  => $power["device_name"],
                            "model"  => $power["model"],
                            "id_server"  => $screen["id_server"],
                            "screen_id" => $new_screen->id ,
                        ]);
                    }
                }
            }
        }
        return Redirect::back()->with('message' ,' The Screens  has been updated');



    }

    public function sync_spl_cpl( Location $location )
    {
        $spls = Spl::all() ;

        foreach($spls as $spl)
        {
            $url = $location->connection_ip."?request=getCplsBySpl&spl_uuid=".$spl->uuid;

            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);
            $spl->cpls()->detach() ;

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
                                dd($cpl_content) ;
                            }



                        }
                    }
                }
            }



        }
    }



}
