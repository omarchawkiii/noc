<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    public function edit()
    {
        $config = Config::all()->first() ;
        return view('config.index' , compact('config'));

    }
    public function update(Request $request)
    {
        $config = Config::all()->first();

        //dd($request->timeStart) ;
        $new_config = $config->update([
            'timeStart' => $request->timeStart ,
            'timeEnd' => $request->timeEnd ,
        ]);
        if($new_config)
        {
            return true ;
        }
        else
        {
            return false ;
        }

    }
    public function update_auto_ingest(Request $request)
    {
        $config = Config::all()->first();

        $new_config = $config->update([
            'autoIngest' => $request->spl_auto_ingest ,
        ]);
        if($new_config)
        {
           return true ;
        }
        else
        {
            return false ;
        }

    }




}
