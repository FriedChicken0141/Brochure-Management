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

        // 権限の変更
        public function change($id)
        {
            $role = User::findOrFail($id);

            $oldRole = $role -> role;

            if($oldRole === 0){
                $role -> role = 1;
            }else if($oldRole === 1){
                $role -> role = 0;
            }
            $role -> save();

            return redirect('/brochures');

        }

        // ユーザー削除
        public function destroy(Request $request)
        {
            $users = User::findOrFail($request -> id);

            $users -> delete();

            return redirect('/brochures/user');
        }
}
