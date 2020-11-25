<?php


namespace App\Repositories;


use App\Models\User;
use phpDocumentor\Reflection\Types\Integer;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function balance()
    {
        return '';
    }

    /**
     * Список пользователей в select, кроме текущего
     * @param int $id
     * @return mixed
     */
    public function getUserList(int $id)
    {
        return User::select('id', 'name')->where('id', '<>', $id)->orderBy('name')->get();
    }


}
