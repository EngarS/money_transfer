<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Integer;

class UserRepository
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Список пользователей в select, кроме текущего
     * @param int $id
     * @return mixed
     */
    public function getUserList(int $id)
    {
        return $this->model->select('id', 'name')->where('id', '<>', $id)->orderBy('name')->get();
    }

    /**
     * Заблокирвать средства пользователя
     * @param int $userId
     * @param int $money
     */
    public function blockMoney(int $userId, int $money)
    {
        $user = $this->model->find($userId);
        $params = [
          'block_money' =>  $user->block_money + $money,
        ];

        $user->update($params);
        Log::info('Блокировка ДС. Блокируемая сумма = ' . $money . ' | Общая сумма: ' . $user->block_money);
    }

    /**
     * Списание ДС с баланса
     * @param int $userId
     * @param int $money
     */
    public function writeOffBalance(int $userId, int $money)
    {
        $user = $this->model->find($userId);
        Log::info('До списания ДС. Сумма списания: ' . $money . ' | Баланс: ' . $user->balance . ' | Блокировано: ' . $user->block_money);
        $params = [
            'balance' => $user->balance - $money,
            'block_money' => $user->block_money - $money,
        ];

        $user->update($params);
        Log::info('Списание ДС. Сумма списания: ' . $money . ' | Баланс: ' . $user->balance . ' | Блокировано: ' . $user->block_money);
    }

    /**
     * Зачисление ДС на баланс
     */
    public function enrollMoney(int $userId, int $money)
    {
        $user = $this->model->find($userId);
        Log::info('До зачисления. Баланс: ' . $user->balance . ' | USerID: ' . $user->id);
        $params = [
          'balance' => $user->balance + $money,
        ];

        $user->update($params);
        Log::info('После зачисления. Баланс: ' . $user->balance . ' | USerID: ' . $user->id);
    }



}
