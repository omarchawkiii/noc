<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Screen;
use App\Models\Spl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;
use Response ;
use SoulDoit\DataTable\SSP;

class SplController extends Controller
{

    /*public function __construct()
    {
        $ssp = new SSP();

        $ssp->enableSearch();
        $ssp->allowExportAllItemsInCsv();
        $ssp->setAllowedItemsPerPage([5, 10, 20, -1]);
        $ssp->frontend()->setFramework('datatablejs');

        $ssp->setColumns([
            ['label'=>'ID',         'db'=>'id',            'formatter' => function ($value, $model) {
                return str_pad($value, 5, '0', STR_PAD_LEFT);
            }],
            ['label'=>'Email',      'db'=>'email',         ],
            ['label'=>'Username',   'db'=>'uname',         ],
            ['label'=>'Created At', 'db'=>'created_at',    ],
            ['label'=>'Action',     'db'=>'id',            'formatter' => function ($value, $model) {
                $btns = [
                    '<button onclick="edit(\''.$value.'\');">Edit</button>',
                    '<button onclick="delete(\''.$value.'\');">Delete</button>',
                ];
                return implode($btns, " ");
            }],
            ['db'=>'email_verified_at'],
        ]);

        $ssp->setQuery(function ($selected_columns) {
            return \App\Models\Screen::select($selected_columns)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->where('id', '!=', 1);
                $query->orWhere('uname', '!=', 'superadmin');
            });
        });

        $this->ssp = $ssp;
    }*/



    public function getscreens(Location $location,  $screen )
    {

        $screen = Screen::find($screen);

        $url = $location->connection_ip . "?request=getSplListInfoByScreenNumber&screen_number=".$screen->screen_number;
        $client = new Client();
        $response = $client->request('GET', $url);
        $contents = json_decode($response->getBody(), true);

        if($contents)
        {
            foreach($contents as $content)
            {
                if($content)
                {
                    foreach($content as $spl)
                    {
                        Spl::updateOrCreate([
                            'uuid' => $spl["uuid"],
                            'screen_id' => $screen->id
                        ],[
                            'uuid'     => $spl["uuid"],
                            'name'     => $spl["title"],
                            'duration'     => $spl["duration"],
                            'available_on'     => $spl["available_on"],
                            'screen_id'     =>$screen->id,
                            'location_id'     =>$location->id,
                        ]);
                    }
                }
            }
        }
        return Redirect::back()->with('message' ,' The Screens  has been updated');
    }

    public function spl_by_screen(Screen $screen)
    {
        $screens = $screen->location->screens ;
        $locations = Location::all() ;
        return view('spls.index', compact('screen','screens','locations'));
    }

    public function get_spl_with_filter(Request $request )
    {

        $location = $request->location;
        $country = $request->country;
        $screen = $request->screen;

        if(isset($location) &&  $location != 'null' )
        {
            $location = Location::find($location) ;
            $screens =$location->screens ;
            $spls =$location->spls ;
            return Response()->json(compact('spls','screens'));
        }
        else
        {
            if(isset($screen) && $screen != 'null' )
            {
                $spls = Screen::find($screen)->spls ;
                return Response()->json(compact('spls'));
            }
            else
            {
                $locations = Location::all() ;
                $spls =null ;
                $screens = null ;
                return view('spls.index', compact('screen','screens','locations'));

            }

        }




    }

}
