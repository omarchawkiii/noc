<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $locations =Location::all() ;
        return view('users.index', compact('users','locations'));
    }

    public function create()
    {
        $locations = Location::all() ;
        return view('users.create', compact('locations'));

    }

    public function store(Request $request)
    {
       $user = User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password) ,
            'email_verified_at' =>now() ,
            'role' => $request->role ,
        ]);

        $new_user =User::find($user->id) ;
        $user->locations()->sync($request->location);

        return redirect()->route('users.index')->with('message' ,'User Has Been Added ');
    }

    public function show($id)
    {
        $locations =Location::all() ;
        $user = User::with('locations')->find($id);
        return Response()->json(compact('user','locations'));
    }

    public function update(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $user->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'role' => $request->role ,

        ]);

        $user->locations()->sync($request->location);

    }

    public function update_password(Request $request)
    {
        $user = User::find($request->id);
        $user->update([
            'password' => $request->password ,
        ]);

    }


    public function destroy($id)
    {
       if(User::find($id)->delete())
       {
        echo "Success" ;
       }
       else
       {
        echo "Faild" ;
       }


    }

    public function get_users(Request $request)
    {

        if( $request->location != null)
        {
            $users = User::whereHas('locations', function($q)use( $request) {
                $q->whereIn('location_id', $request->location);
            })->with('locations')->get();

        }
        else
        {
            $users = User::with('locations')->get() ;
        }

        return Response()->json(compact('users'));

    }


}
