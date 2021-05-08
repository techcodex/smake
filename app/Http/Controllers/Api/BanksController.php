<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankStoreRequest;
use App\Http\Requests\BankUpdateRequest;
use App\Repository\Banks\BankRepository;
use Exception;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        try {
            $data = BankRepository::index();
            $response['status'] = config('status.OK');
            $response['message'] = "";
            $response['result']['banks'] = $data;
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankStoreRequest $request)
    {
        $response = [];
        try {
            $data = $request->all();
            $bank = BankRepository::store($data);

            $response['status'] = config('status.OK');
            $response['message'] = "Bank Created Sucessfully";
            $response['result']['bank'] = $bank;

        } catch (Exception $ex) {
            $response['status'] = config('status.OK');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankUpdateRequest $request, $id)
    {
        $response = [];
        try {
            $data = $request->all();
            $bank = BankRepository::update($data,$id);
            
            $response['status'] = config('status.OK');
            $response['message'] = "Bank Updated Successfully";
            $response['result']['bank'] = $bank;

        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = [];
        try {
            BankRepository::delete($id);
            $response['status'] = config('status.OK');
            $response['message'] = "Bank Deleted Successfully";
            $response['result'] = null;
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }

    /**
     * Get Sum of Transactions
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function getTransactionSum($id)
    {
        $response = [];
        try {
            $result = BankRepository::getTransactionSum($id);
            $response['status'] = config('status.OK');
            $response['message'] = "";
            $response['result']['transaction_sum'] = $result;
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }
}
