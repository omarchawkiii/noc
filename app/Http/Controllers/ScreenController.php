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
use Illuminate\Support\Facades\Auth;

class ScreenController extends Controller
{
    public function index(Request $request): View
    {
        $screens = Screen::all();
        return view('screens.index', compact('screens'));
    }

    public function show(Request $request, Screen $screen): View
    {
        return view('screens.show', compact('screen'));
    }

    public function create(): View
    {
        if( Auth::user()->role != 1)
        {
            $locations = Auth::user()->locations ;
        }
        else
        {
            $locations = Location::all() ;
        }
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
