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
    public function get_snmp_with_map(Request $request )
    {

        $errors = Snmp::with('location')->groupBy('city')->get() ;
        dd($errors) ;
        $data = $request->data;
        $zoomLevel = $request->zoomLevel;

        if(isset($data) &&  $data != 'null' )
        {
            if($zoomLevel > 6)
            {
                $locations = array(
                    array("location" => "Kuala Lumpur", "status" => "red"),
                    array("location" => "Johor", "status" => "green"),
                    array("location" => "Selangor", "status" => "green")
                );
                $locations = array(
                    array("location" => "Kedah State, Malaysia",
                              "latitude" => 6.155672, "longitude" => 100.569649,
                              "status" => "green",
                              "locations" => array(
                                     array("location" => "Location 1", "latitude" => 6.1, "longitude" => 100.5, "status" => "green"),
                                      array("location" => "Location 2", "latitude" => 6.2, "longitude" => 100.6, "status" => "red")
                               )),
                    array("location" => "Perak, Malaysia", "latitude" => 4.693950, "longitude" => 101.117577, "status" => "green",
                        "locations" => array(
                            array("location" => "Location 3", "latitude" => 4.7, "longitude" => 101.1, "status" => "green"),
                            array("location" => "Location 4", "latitude" => 4.8, "longitude" => 101.2, "status" => "red")
                        )),
                    array("location" => "Perlis, Malaysia", "latitude" => 6.443589, "longitude" => 100.216599, "status" => "green"),
                    array("location" => "Penang, Malaysia", "latitude" => 5.285153, "longitude" => 100.456238, "status" => "red"),
                    array("location" => "Negeri Sembilan, Malaysia", "latitude" => 2.731813, "longitude" => 102.252502, "status" => "green"),
                    array("location" => "Kelantan Province, Malaysia", "latitude" => 6.125397, "longitude" => 102.238068, "status" => "red"),
                    array("location" => "Sabah, Malaysia", "latitude" => 5.420404, "longitude" => 116.796783, "status" => "red"),
                    array("location" => "Pahang, Malaysia", "latitude" => 3.974341, "longitude" => 102.438057, "status" => "red"),
                    array("location" => "Selangor, Malaysia", "latitude" => 3.509247, "longitude" => 101.524803, "status" => "green"),
                    array("location" => "Johor, Malaysia", "latitude" => 1.937344, "longitude" => 103.366585, "status" => "red"),
                    array("location" => "Selangor, Malaysia", "latitude" => 3.072751, "longitude" => 101.423454, "status" => "red"),
                    array("location" => "Johor, Malaysia", "latitude" => 1.527549, "longitude" => 103.745476, "status" => "red"),
                    array("location" => "Puchong, Malaysia", "latitude" => 3.025340, "longitude" => 101.617767, "status" => "green"),
                    array("locatio" => "Subang Jaya, Malaysia", "latitude" => 3.043840, "longitude" => 101.580620, "status" => "red")
                );

            }
            else
            {


                $locations = array(
                    array("location" => "Kuala Lumpur", "status" => "red"),
                    array("location" => "Johor", "status" => "green"),
                    array("location" => "Selangor", "status" => "green")
                );
                $locations = array(
                    array("location" => "Kedah State, Malaysia",
                              "latitude" => 6.155672, "longitude" => 100.569649,
                              "status" => "green",
                              "locations" => array(
                                     array("location" => "Location 1", "latitude" => 6.1, "longitude" => 100.5, "status" => "green"),
                                      array("location" => "Location 2", "latitude" => 6.2, "longitude" => 100.6, "status" => "green")
                               )),
                    array("location" => "Perak, Malaysia", "latitude" => 4.693950, "longitude" => 101.117577, "status" => "green",
                        "locations" => array(
                            array("location" => "Location 3", "latitude" => 4.7, "longitude" => 101.1, "status" => "green"),
                            array("location" => "Location 4", "latitude" => 4.8, "longitude" => 101.2, "status" => "green")
                        )),
                  /*  array("location" => "Perlis, Malaysia", "latitude" => 6.443589, "longitude" => 100.216599, "status" => "green"),
                    array("location" => "Penang, Malaysia", "latitude" => 5.285153, "longitude" => 100.456238, "status" => "green"),
                    array("location" => "Negeri Sembilan, Malaysia", "latitude" => 2.731813, "longitude" => 102.252502, "status" => "green"),
                    array("location" => "Kelantan Province, Malaysia", "latitude" => 6.125397, "longitude" => 102.238068, "status" => "green"),
                    array("location" => "Sabah, Malaysia", "latitude" => 5.420404, "longitude" => 116.796783, "status" => "green"),
                    array("location" => "Pahang, Malaysia", "latitude" => 3.974341, "longitude" => 102.438057, "status" => "green"),
                    array("location" => "Selangor, Malaysia", "latitude" => 3.509247, "longitude" => 101.524803, "status" => "green"),
                    array("location" => "Johor, Malaysia", "latitude" => 1.937344, "longitude" => 103.366585, "status" => "green"),
                    array("location" => "Selangor, Malaysia", "latitude" => 3.072751, "longitude" => 101.423454, "status" => "green"),
                    array("location" => "Johor, Malaysia", "latitude" => 1.527549, "longitude" => 103.745476, "status" => "green"),
                    array("location" => "Puchong, Malaysia", "latitude" => 3.025340, "longitude" => 101.617767, "status" => "green"),
                    array("locatio" => "Subang Jaya, Malaysia", "latitude" => 3.043840, "longitude" => 101.580620, "status" => "green")*/
                );

            }


            return Response()->json(compact('locations'));
        }
        else
        {

            // Convert the array to JSON format

            $snmps=null ;
            $locations = Location::all() ;

            return view('snmps.map', compact('snmps','locations'));
        }

    }

}
