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
            'username' => $request->username ,
            'last_name'=> $request->last_name ,
        ]);

        $new_user =User::find($user->id) ;
        if($request->location)
        {
            foreach($request->location as $location)
            {
                $location_data = Location::find($location) ;
                $this->api_request($location->connection_ip,"create_user", $user->email, $user->$request->password, $user->username, $user->name, $user->last_name, 1, 1, 0, $location->email, $location->password);
            }
            $user->locations()->sync($request->location);
        }


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
            'username' => $request->username ,
            'last_name'=> $request->last_name ,
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
    function api_request($apiUrl,$action, $email_user, $password_user, $user_name_user, $first_name, $last_name, $add_user_status, $add_user_group, $enable_email_notifications, $username,$password) {
        // Prepare the request data
        $requestData = [
            'action' => $action,

            'email_user' => $email_user,
            'password_user' => $password_user,
            'user_name_user' => $user_name_user,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'add_user_status'=> $add_user_status,
            'add_user_group' => $add_user_group,
            'enable_email_notifications' => $enable_email_notifications,
            'username' => $username,
            'password' => $password,
        ];
        // Initialize cURL session
        $ch = curl_init($apiUrl);
        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
       // print_r($response);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Curl error: ' . curl_error($ch)];
        }

        // Close cURL session
        curl_close($ch);

        // Process the API response
        if (!$response) {
            return ['error' => 'Error occurred while sending the request.'];
        } else {
            return json_decode($response, true);
        }
    }



}
