<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Location;
use App\Models\Macro;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MacroController extends Controller
{
    public function getMacros($location)
    {

        $location = Location::find($location) ;

        $url = $location->connection_ip."?request=getMacros";
        try{
            $client = new Client();
            $response = $client->request('GET', $url);
            $contents = json_decode($response->getBody(), true);

            if($contents)
            {
                foreach($contents as $content)
                {
                    if($content)
                    {
                        foreach($content as $macro_section)
                        {
                            foreach($macro_section['macros_section'] as $macro_element)
                            {
                                Macro::updateOrCreate([
                                    'idmacro_config' => $macro_element['idmacro_config'],
                                    'location_id' => $location->id,
                                ],[
                                    'section_title' => $macro_section['title'],
                                    'title' => $macro_element['title'],
                                    'command' => $macro_element['command'],
                                    'idmacro_config' => $macro_element['idmacro_config'],
                                    'idsections_macro' => $macro_section['idsections_macro'],
                                    'location_id'     =>$location->id,
                                ]);
                            }
                        }
                    }
                }
            }
        }
        catch (RequestException $e) {
            // Log de l'erreur ou traitement spécifique
            echo " message: " . $e->getMessage();
        }

    }
}
