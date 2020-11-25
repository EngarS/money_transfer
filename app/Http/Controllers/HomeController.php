<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $userService;
    private $transactionRepository;

    /**
     * HomeController constructor.
     * @param UserService $userService
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(UserService $userService, TransactionRepository $transactionRepository)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = $this->transactionRepository->getTransactionByUser(Auth::id());

        return view('home', compact('transactions'));
    }
}
