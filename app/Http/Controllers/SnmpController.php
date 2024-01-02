<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Snmp;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SnmpController extends Controller
{
    public function getsnmp($location)
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=getSnmpErrors";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);
        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $snmp)
                    {
                        Snmp::updateOrCreate([
                            'id_snmp' => $snmp["id"],
                            'location_id' => $location->id,
                        ],[
                            'id_snmp'=> $snmp['id'],
                            'ip_address'=> $snmp['ip_address'],
                            'type'=> $snmp['type'],
                            'trap_data'=> $snmp['trap_data'],
                            'snmp_created_at'=> $snmp['created_at'],
                            'category'=> $snmp['category'],
                            'severity'=> $snmp['severity'],
                            'serverName'=> $snmp['serverName'],
                            'location_id' => $location->id ,
                        ]);
                    }
                }
            }
        }

    }

    public function get_snmp_with_filter(Request $request )
    {

        $location = $request->location;

        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $snmps =Snmp::all();
            $snmps =$snmps->where('location_id',$location->id);
            return Response()->json(compact('snmps','location'));
        }
        else
        {
            $snmps=null ;
            $locations = Location::all() ;
            return view('snmps.index', compact('snmps','locations'));
        }

    }
}
