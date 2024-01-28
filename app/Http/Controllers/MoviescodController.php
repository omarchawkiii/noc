<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Moviescod;
use App\Models\Nocspl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MoviescodController extends Controller
{
    public function getMoviesCods($location)
    {
        $location = Location::find($location) ;
        $url = $location->connection_ip."?request=getMoviesCods";
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $moviescod)
                    {
                        Moviescod::updateOrCreate([
                            'moviescods_id' => $moviescod['id'],
                            'location_id' => $location->id,
                        ],[

                            'moviescods_id' => $moviescod['id'],
                            'code' => $moviescod['code'],
                            'title' => $moviescod['title'],
                            'titleShort' => $moviescod['titleShort'],
                            'last_update' => $moviescod['last_update'],
                            'status' => $moviescod['status'],
                            'location_id'     =>$location->id,
                        ]);

                    }
                }
            }
        }
     //   return Redirect::back()->with('message' ,' The cpls  has been updated');
    }

    public function get_spl_and_movies(Request $request)
    {
        $location = $request->location;
        //$location = Location::find($location) ;
        $movies = Moviescod::where('location_id',$request->location)->where('status','unlinked')->get() ;
        $nos_spls = Nocspl::all() ;
        return Response()->json(compact('nos_spls','movies'));

    }
    public function add_movies_to_spls(Request $request)
    {

        $moviescod = Moviescod::findOrFail($request->movie_id)->update([
        'nocspl_id' => $request->spl_id,
        'status' => "linked"
        ]);

        if($moviescod)
        {
            echo "Success" ;
        }
        else
        {
            echo "Failed" ;
        }
    }

    public function get_spl_and_movies_linked(Request $request)
    {
        $location = $request->location;
        //$location = Location::find($location) ;
        $movies = Moviescod::with('nocspl')->where('location_id',$request->location)->where('status','linked')->get() ;

        return Response()->json(compact('movies'));

    }


}
