<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $userRepository;
    private $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Список пользователей
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function users()
    {
        $users = $this->userRepository->getAll();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Список всех транзакций
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function transactions()
    {
        $transactions = $this->transactionRepository->getAllTransaction();

        return view('admin.transactions.index', compact('transactions'));
    }
}
