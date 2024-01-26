<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
	public function index()
	{
        $users = User::latest()->get();
		return view('index.index', compact('users'));
	}

    public function getUserByUsername($username)
    {
        $user = User::where('username', $username)->first();
        return view('index.users.show', compact('user'));
    }
}
