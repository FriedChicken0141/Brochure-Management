<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        public function user(Request $request)
        {
            $users = User::all();

            return view ('user',['users' => $users]);
        }
}
