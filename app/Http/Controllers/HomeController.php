<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index()
    {
        return view('welcome');
    }
}
