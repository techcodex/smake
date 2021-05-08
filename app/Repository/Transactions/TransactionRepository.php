<?php

namespace App\Repository\Transactions;

use App\Date;
use App\Repository\Banks\BankRepository;
use App\Transaction;
use Exception;

class TransactionRepository
{
    /**
     * Store New Resource in Storage
     */
    public static function store($data)
    {
        extract($data);
        try {
            // finding Bank
            $bank = BankRepository::find($bank_id);

            // Storing New Resource
            $transaction = Transaction::create([
                'bank_id' => $bank->id,
                'amount' => $amount,
                'description' => $description,
                'date' => Date::setDate($date),
            ]);

            if (empty($transaction)) {
                throw new Exception("Opps Something Went Wrong!");
            }

            // Getting Formated Transaction Data
            $transaction_data = self::getFormatedTransaction($transaction);
            return $transaction_data;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        
    }

    /**
     * Getting Formated Transaction Data
     */
    public static function getFormatedTransaction($transaction)
    {
        // Getting Bank
        $bank = $transaction->bank;

        // Getting Formated Bank Data
        $bank_data = BankRepository::getFormmatedBank($bank);

        $data = [
            'bank' => $bank_data,
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'description' => $transaction->description,
            'date' => Date::getDate($transaction->date),
        ];
        return $data;
    }

    /**
     * Deleting Resource From Storage
     */
    public static function delete($id)
    {
        try {
            $transaction = self::find($id);
            // Deleting Transaction Record
            $transaction->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * Finding Transaction From Storage
     */
    public static function find($id)
    {
        $transaction = Transaction::find($id);
        if (empty($transaction))
        {
            throw new Exception("Transaction Not Found");
        }
        return $transaction;
    }
    
    /**
     * Updating Resource in Storage
     */
    public static function update($data, $id = 0)
    {
        extract($data);

        try {
            // Finding Transaction
            $transaction = self::find($id);

            // Finding Bank
            $bank = BankRepository::find($bank_id);

            // Updating Transaction
            $transaction->amount = $amount;
            $transaction->date = Date::setDate($date);
            $transaction->bank_id = $bank->id;
            $transaction->description = $description;
            $transaction->save();
            
            // Getting Formatted Transaction 
            $transaction_data = self::getFormatedTransaction($transaction);
            return $transaction_data;
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
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            $data[] = self::getFormatedTransaction($transaction);
        }
        return $data;
    }
}