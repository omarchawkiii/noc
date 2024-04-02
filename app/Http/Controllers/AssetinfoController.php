<?php

namespace App\Http\Controllers;

use App\Models\Assetinfo;
use App\Models\Location;
use App\Models\Screen;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AssetinfoController extends Controller
{
    public function get_asset_infos($location )
    {

        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=get_asset_info";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $asset_info)
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
                            'screen_id'     =>$screen->id,
                            'location_id'     =>$location->id,
                        ]);
                    }

                }
            }
        }
        return Redirect::back()->with('message' ,' The Assent infos  has been updated');
    }
}
