<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreenControllerStoreRequest;
use App\Models\Screen;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ScreenController extends Controller
{
    public function index(Request $request): Response
    {
        $screens = Screen::all();

        return view('screens.index', compact('screens'));
    }

    public function show(Request $request, Screen $screen): Response
    {
        return view('screens.show', compact('screen'));
    }

    public function create(): View
    {
        $locations = Location::all() ;
        return view('screens.create', compact('locations'));
    }

    public function store(ScreenControllerStoreRequest $request): Response
    {
        $screen = Screen::create($request->validated());

        return redirect()->route('screens.index');
    }
}
