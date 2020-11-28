<?php


namespace App\Repositories;


use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionRepository
{
    private $model;

    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }


    public function getAllTransaction()
    {
        return $this->model->all();
    }

    public function getTransactionByUser($id)
    {
        return $this->model->where('user_id', $id)->with('recipient')->get();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function store(array $params)
    {
        return $this->model->create($params);
    }

    public function completeTransaction(int $id)
    {
        Log::info('Завершение транзакции');
        $transaction = $this->model->find($id);
        $params = [
          'done' => 1,
          'date_end' => now(),
        ];
        $transaction->update($params);
        Log::info('Транзакция №' . $transaction->id .' завершена');

    }
}
