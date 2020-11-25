<?php


namespace App\Repositories;


use App\Models\Transaction;

class TransactionRepository
{
    public function getAllTransaction()
    {
        return Transaction::all();
    }

    public function getTransactionByUser($id)
    {
        return Transaction::where('user_id', $id)->get();
    }
}
