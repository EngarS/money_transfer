<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create()
    {
        $users = $this->userRepository->getUserList(Auth::id());
        return view('transactions.create', compact('users'));
    }

    public function store(TransactionStoreRequest $request)
    {
        dd($request->input());
    }
}
