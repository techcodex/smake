<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Repository\Transactions\TransactionRepository;
use Exception;
use Illuminate\Http\Request;

class TransactionsController extends Controller
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
            $transactions = TransactionRepository::index();
            $response['status'] = config('status.OK');
            $response['message'] = "";
            $response['result']['transactions'] = $transactions;
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
    public function store(TransactionStoreRequest $request)
    {
        $response = [];
        try {
            $data = $request->all();
            $result = TransactionRepository::store($data);
            $response['status'] = config('status.OK');
            $response['message'] = "Transaction Store Successfully";
            $response['result']['transaction'] = $result;
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
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
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $transaction = TransactionRepository::update($data,$id);
            $response['status'] = config('status.OK');
            $response['message'] = "Transaction Updated Successfully";
            $response['result']['transaction'] = $transaction;
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
            TransactionRepository::delete($id);
            $response['status'] = config('status.OK');
            $response['message'] = "Transaction Deleted Successfully";
            $response['result'] = null;
        } catch (Exception $ex) {
            $response['status'] = config('status.UNPROCESSABLE');
            $response['message'] = $ex->getMessage();
            $response['result'] = null;
        }
        return $response;
    }
}
