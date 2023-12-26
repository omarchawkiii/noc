<?php

namespace App\Http\Controllers;

use App\Models\Diskusage;
use App\Models\Location;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DiskusageController extends Controller
{
    public function getdiskusage($location)
    {
        $location = Location::find($location)->first() ;
        $url = $location->connection_ip . "?request=getLmsDiskUsage";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            $free_space_percentage=($contents['usedSpace'] * 100) / $contents['totalSpace'];

            Diskusage::updateOrCreate([
                'location_id' => $location->id
            ],[
                'session' => $contents['session'],
                'type' => $contents['type'],
                'totalSpaceFormatted' => $contents['totalSpaceFormatted'],
                'usedSpaceFormatted' => $contents['usedSpaceFormatted'],
                'cpls_complete' => $contents['cpls_complete'],
                'cpls_incomplete' => $contents['cpls_incomplete'],
                'Kdms_expired' => $contents['Kdms_expired'],
                'Kdms_not_valid' => $contents['Kdms_not_valid'],
                'Kdms_valid' => $contents['Kdms_valid'],
                'splCount' => $contents['splCount'],
                'free_space_percentage' => $free_space_percentage ,
                'location_id' => $location->id,

            ]);
        }
        return Redirect::back()->with('message' ,' The Disk Usage  has been updated');
    }
}
