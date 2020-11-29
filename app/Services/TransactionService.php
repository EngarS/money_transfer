<?php


namespace App\Services;


use App\Jobs\TransferMoneyJob;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    private $transactionRepository;
    private $userRepository;

    public function __construct(TransactionRepository $transactionRepository, UserRepository $userRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;

    }

    /**
     * @param array $params
     */
    public function store(array $params)
    {
        $prepareData = $this->prepareData($params);
        $transaction = $this->transactionRepository->store($prepareData);
        $this->blockUserMoney($transaction->user_id, $transaction->money);

        TransferMoneyJob::dispatch($transaction->id)->delay($transaction->date_start);

    }

    /**
     *
     * @param array $params
     * @return array
     */
    public function prepareData(array $params)
    {
        $params['date_start'] = (isset($params['delay']) && $params['delay'] == 1)? strtotime($params['date_start']) : now()->format('Y-m-d H:i:s');

        return $params;
    }

    /**
     * Заблокирвать средства пользователя
     * @param int $userId
     * @param int $money
     */
    public function blockUserMoney(int $userId, int $money)
    {
        $this->userRepository->blockMoney($userId, $money);
    }

    public function completeTransaction($transactionId)
    {
        $transaction = $this->transactionRepository->find($transactionId);

        $this->userRepository->writeOffBalance($transaction->user_id, $transaction->money);
        $this->userRepository->enrollMoney($transaction->recipient_user_id, $transaction->money);

        $this->transactionRepository->completeTransaction($transaction->id);
    }
}
