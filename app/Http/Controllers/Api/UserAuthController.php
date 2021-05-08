<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Repository\Users\UserRepository;
use Exception;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    /**
     * @param Illuminate\Http\Request
     * 
     * Storing New Resource in Storage
     * 
     * @return json response
     */
    public function register(UserRegisterRequest $request)
    {
        $response = [];
        try {
            $data = $request->all();
            $response = UserRepository::register($data);
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }

    /**
     * @param Illuminate\Http\Request
     * 
     * User Authentication
     * 
     * @return json response
     */
    public function login(Request $request)
    {
        $response = [];
        try {
            $data = $request->all();
            $response = UserRepository::login($data);
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }
}
