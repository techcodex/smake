<?php

namespace App\Repository\Users;

use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository 
{
    /**
     * Register New User in Storage
     */
    public static function register($data)
    {
        extract($data);
        $response = [];

        // Creating New User
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // Creating Access token
        $access_token = $user->createToken('authToken')->accessToken;

        // Getting formatted User Data
        $user_data = self::getFormattedUser($user);
        
        // Returning response data
        $response['status'] = config('status.OK');
        $response['message'] = "";
        $response['result']['user'] = $user_data;
        $response['result']['access_token'] = $access_token;

        return $response;

    }

    /**
     * @param App\User
     * Getting Formated User Data
     */
    public static function getFormattedUser($user)
    {
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
        return $data;
    }
    /**
     * User Authentication 
     */
    public static function login($data)
    {
        extract($data);
        
        $response = [];
        
        // Checking User Credentails
        if (!auth()->attempt(['email'=>$email,'password'=>$password])) { 
            throw new Exception("Invalid Credentails");
        }

        // creating Access Token
        $access_token = auth()->user()->createToken('authToken')->accessToken;

        // Getting Auth User
        $user = Auth::user();
        
        // Getting formatted User Data
        $user_data = self::getFormattedUser($user);

        // Returning response data
        $response['status'] = config('status.OK');
        $response['message'] = "";
        $response['result']['user'] = $user_data;
        $response['result']['access_token'] = $access_token;

        return $response;
    }
}