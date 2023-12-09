<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function index(Request $request): View
    {
        $locations = Location::all();

        return view('locations.index', compact('locations'));
    }

    public function create(): View
    {

        return view('locations.create');
    }

    public function show(Location $location): View
    {
        return view('locations.show', compact('location'));
    }

    public function store(LocationStoreRequest $request)
    {

        $location = Location::create($request->validated());
        return redirect()->route('location.index')->with('message' ,' The location has been created ');
    }

    public function edit(Location $location): View
    {

        return view('locations.edit',compact('location') );
    }

    public function update (Location $location , LocationStoreRequest $request )
    {
        $location->update($request->validated());

        return redirect()->route('location.index')->with('message' ,' The location has been updated  ');
    }



}
