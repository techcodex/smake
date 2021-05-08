<?php

namespace App\Repository\Banks;

use App\Bank;
use Exception;
use Illuminate\Support\Facades\DB;

class BankRepository 
{
    /**
     * Storing new Resource in Storage
     */
    public static function store($data)
    {
        $bank = Bank::create($data);
        if (empty($bank)) {
            throw new Exception("Opps Something Went Wrong Try Again");
        }
        // getting formated Bank Data
        $bank_data = self::getFormmatedBank($bank);
        return $bank_data;
    }

    /**
     * Getting Formatted Bank Data
     */
    public static function getFormmatedBank($bank)
    {
        $data = [
            'id' => $bank->id,
            'name' => $bank->name,
        ];
        return $data;
    }

    /**
     * Update Specified Resource From Storage
     */
    public static function update($data, $id = 0)
    {
        extract($data);
        try {
            $bank = self::find($id);

            // updating resource in Storage
            $bank->name = $name;
            $bank->save();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        // getting formated Bank Data
        $bank_data = self::getFormmatedBank($bank);
        return $bank_data;
    }

    /**
     * Finding Resource From Storage
     */
    public static function find($id = 0) 
    {
        $bank = Bank::find($id);
        if (empty($bank)) {
            throw new Exception("Bank Not Found");
        }
        return $bank;
    }

    /**
     * Deleting Resource From Storage
     */
    public static function delete($id)
    {
        try {
            $bank = self::find($id);

            //deleting bank transaction records
            $bank->transactions()->delete();

            // deleting bank
            $bank->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Get List of Resource From Storage
     */
    public static function index()
    {
        $data = [];
        $banks = Bank::all();

        foreach ($banks as $bank) {
            $data[] = self::getFormmatedBank($bank);
        }
        return $data;
    }

    /**
     * Get Sum of Bank Transactions
     */
    public static function getTransactionSum($id)
    {
        try {
            // Finding Bank From Resource
            $bank = self::find($id);

            //getting Bank Total Transaction Amount 
            $total = DB::table('banks AS b')
                ->select(DB::raw('SUM(t.amount) as transaction_sum'))
                ->join('transactions AS t','t.bank_id','b.id')
                ->where([
                    ['b.deleted_at', null],
                    ['t.deleted_at', null],
                    ['t.bank_id', $bank->id]
                ])
                ->get()->first();

            return $total->transaction_sum == null ? 0 : $total->transaction_sum;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}