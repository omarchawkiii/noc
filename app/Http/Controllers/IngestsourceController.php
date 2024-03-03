<?php

namespace App\Http\Controllers;

use App\Models\Ingestsource;
use Illuminate\Http\Request;

class IngestsourceController extends Controller
{
    public function index ()
    {
        $sources = Ingestsource::all() ;
        return view('ingestersources.index', compact('sources'));
    }
    public function store(Request $request)
    {

       $source = Ingestsource::create([
            'defaultlocation_add_form' =>  $request->defaultlocation_add_form,
            'usb_content_add_form' =>  $request->usb_content_add_form,
            'defaultContent_add_form' =>  $request->defaultContent_add_form,
            'serverName' =>  $request->serverName,
            'server_ip' =>  $request->server_ip,
            'ingestProtocol' =>  $request->ingestProtocol,
            'usernameServer' =>  $request->usernameServer,
            'passwordServer' =>  $request->passwordServer,
            'path' =>  $request->path,
        ]);



        return redirect()->route('ingestersources.index')->with('message' ,'Source Has Been Added ');
    }
}
