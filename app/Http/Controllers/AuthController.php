<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Route;

class AuthController extends Controller
{
    public function login(Request $request){
        //use GuzzleHttp\Exception\GuzzleException;
        // use GuzzleHttp\Client;
      /*
        $http = new Client();
        try{
            $response = $http->post('http://nowcommunity.test/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'nYntg7DEmnWwerUDc8PyW8WPTt2sEHQ84us2D7Tz',
                    'username' => 'jbarton@example.net' ,// $request->username,
                    'password' => 'password' ,// $request->password,
                ],
            ]);
            //return json_decode((string) $response->getBody(), true);
            return $response->getBody();
        }
        catch(GuzzleException $e){
            if ($e->getCode() === 400){
                return response()->json('Invalid Request. Please enter a username or a password', $e->getCode());
            }else if ($e->getCode() ===401){
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }else if ($e)
            return response()->json('Something went wrong on the server', $e->getCode());
        }
    */   
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $tokenRequest = Request::create(
            env('PASSPORT_LOGIN_ENDPOINT'), //'http://nowcommunity.test/oauth/token',
            'post'
        );
        $response = Route::dispatch($tokenRequest);
        return $response;
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        return  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
    
    public function logout(){
        auth()->user()->tokens->each(function($token, $key){
            $token->revoke();
        });   
        return response()->json('Logged out successfully',200);
    }
}
