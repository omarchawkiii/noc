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
        ]);



        $new_user =User::find($user->id) ;
        $user->locations()->sync($request->location);

        return redirect()->route('users.index')->with('message' ,'User Has Been Added ');
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
            $users = User::all() ;
        }

        return Response()->json(compact('users'));

    }


}
