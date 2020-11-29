<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $userRepository;
    private $transactionRepository;
    private $transactionService;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository, TransactionService $transactionService)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
    }

    public function create()
    {
        $users = $this->userRepository->getUserList(Auth::id());

        return view('transactions.create', compact('users'));
    }

    public function store(TransactionStoreRequest $request)
    {
        $this->transactionService->store($request->input());

        return redirect('/home')->with('success', 'Транзация создана.');
    }


}
