<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        public function user(Request $request)
        {
            $users = User::where('email','!=','_deleted')
                ->orderBy('created_at')
                ->get();

            return view ('user',['users' => $users]);
        }

        // 権限の変更
        public function change($id)
        {
            $role = User::findOrFail($id);

            $oldRole = $role -> role;

            if($oldRole === 0){
                $role->role = 1;
            }else if($oldRole === 1){
                $role->role = 0;
            }
            $role->save();

            return redirect('/brochures/user');

        }

        // ユーザー削除（疑似削除）
        public function destroy(Request $request)
        {
            $users = User::findOrFail($request->id);

            $users->name = '削除されたユーザー';
            $users->email = '_deleted';
            $users->role = '0';
            $users->save();

            return redirect('/brochures/user');
        }

        // ユーザー管理画面検索
        public function search(Request $request)
        {
            // リクエストからキーワードを取得
            $keyword = $request->input('keyword');
            // クエリを作成
            $query = User::query();

            // 空でない場合、検索処理を実行
            if (!empty($keyword)) {
                // 管理で検索する場合、ロールカラムで1を検索
                if($keyword == '管理') {
                    $query->where('role',1);
                }
                // 一般で検索する場合、ロールカラムで0を検索
                elseif($keyword == '一般') {
                    $query->where('role',0);
                }
                else {
                    $query->where('name','like','%'.$keyword.'%');
                }}

            // 検索検索を10件表示
            $users = $query->orderBy('id','asc')->paginate(10);

            return view('/user',['users' => $users,'keyword' => $keyword]);
        }
}
