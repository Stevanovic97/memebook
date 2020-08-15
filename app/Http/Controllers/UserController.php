<?php

namespace App\Http\Controllers;

use App\Repository\IRepositories\UserIRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserIRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($user_id)
    {
        $user = $this->userRepository->getUser($user_id);
        return view('user.showUser')->with(compact('user'));
    }
}
