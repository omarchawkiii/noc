<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreenControllerStoreRequest;
use App\Http\Requests\ScreenStoreRequest;
use App\Models\Screen;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;

class ScreenController extends Controller
{
    public function index(Request $request): View
    {
        /*
        $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=";
        $client = new Client();

        $response = $client->request('GET', $url);
        $result = json_decode($response->getBody(), true);

        dd($result) ;
 */
        $screens = Screen::all();


        return view('screens.index', compact('screens'));
    }

    public function show(Request $request, Screen $screen): View
    {

        return view('screens.show', compact('screen'));
    }

    public function create(): View
    {
        $locations = Location::all() ;
        return view('screens.create', compact('locations'));
    }


    public function store(ScreenStoreRequest $request)
    {
        $screen = Screen::create($request->validated());

        return redirect()->route('screens.index');
    }

    public function edit(Screen $screen): View
    {

        return view('screens.edit',compact('screen') );
    }
}
