<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Brochure;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use function App\Models\Approval;

class WorkFlowController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }

        // 申請機能
        public function request($id)
        {
            $brochure = Brochure::findOrFail($id);

            return view('request', ['brochures' => $brochure]);
        }
        public function application(Request $request)
        {
            // userテーブルからidを取得
            $user_id = auth() -> user() -> id;

            $brochure = Brochure::findOrFail($request -> id);

            // DBへ登録
            Approval::create([
                'user_id' => $user_id,
                'brochure_id' => $brochure->id,
                'quantity' => $request->quantity,
                'detail' => $request->detail,
            ]);

            return redirect('/brochures');
        }

        // 申請一覧画面
        public function Consent(Request $request)
        {
            $userRole = auth() -> user() -> role;

            // 管理者（1）の場合、全ての申請を表示
            if($userRole == '1'){

                $approvals = approval::sortable()->paginate(20);

            } else {
            // 一般（0）の場合、自分の申請のみを表示
                $userId = auth() -> user() -> id;
                $approvals = Approval::where('user_id',$userId) -> sortable()-> paginate(20);
            }

            return view('Consent',[
                'approvals' => $approvals
            ]);
        }

        // 申請を承認
        public function approval($id)
        {
            $approvals = approval::findOrFail($id);

            // 在庫数から使用数を減算
            $approvedQuantity = $approvals -> quantity;

            $brochure = Brochure::findOrFail($approvals -> brochure_id);

            $Quantity = $brochure -> quantity - $approvedQuantity;

            if($Quantity < 0){
                return redirect() -> back() -> with('error','在庫数が不足しているため承認できませんでした。');
            }

            $brochure -> update(['quantity' => $Quantity]);

            // カラムの値を承認に変更
            $approvals -> status = '承認';
            // 保存
            $approvals -> save();

            // 決裁履歴へ遷移
            return redirect('/brochures/result');
        }

        // 申請を否認（差戻）
        public function disapproval($id)
        {
            $approvals = Approval::findOrFail($id);
            // カラムの値を承認に変更
            $approvals -> status = '差戻';
            // 保存
            $approvals -> save();

            return redirect('/brochures/result');
        }

        // 承認履歴を表示
        public function result(Request $request)
        {
            $userRole = auth() -> user() -> role;

            // 管理（1）の場合、全ての申請を取得
            if($userRole == '1'){
                $approvals = approval::sortable()->paginate(20);

            } else {

            // 一般（0）の場合、自分の申請のみ取得
                $userId = auth() -> user() -> id;
                $approvals = Approval::where('user_id',$userId) -> sortable()-> paginate(20);

            }

            return view('result',[
                'approvals' => $approvals
            ]);
        }

        // 承認申請を差戻し
        public function remand($id)
        {
            $approvals = Approval::findOrFail($id);
            // カラムの値を申請中に変更
            $approvals -> status = '差戻';
            // 保存
            $approvals -> save();
            // 承認した使用数を在庫数に加算
            $requestQuantity = $approvals -> quantity;

            $brochure = Brochure::findOrFail($approvals -> brochure_id);

            $formerQuantity = $brochure -> quantity + $requestQuantity;

            $brochure -> update(['quantity' => $formerQuantity]);

            // 申請一覧へ遷移
            return redirect('/brochures/consent');
        }

        // 申請削除
        public function destroy(Request $request)
        {
            $approvals = Approval::findOrFail($request -> id);
            $approvals -> delete();

            return redirect('/brochures/consent');
        }

        // 申請編集
        public function reapplication(Request $request)
        {
            $approvals = Approval::findOrFail($request -> id);
            $brochures = Brochure::all();

            return view('reapplication',['approvals' => $approvals,'brochures' => $brochures]);
        }

        // 申請内容を更新
        public function update(request $request)
        {
            $approvals = Approval::findOrFail($request -> id);
            // 現在のステータスカラムを情報を取得
            $oldStatus = $approvals -> status;

            // 編集した申請内容を格納
            $approvals -> quantity = $request -> quantity;
            $approvals -> detail = $request -> detail;
            $approvals -> updated_at = $request -> updated_at;

            // 現在のステータスが差戻なら、再申請中に変更
            if($oldStatus === '差戻'){
                $approvals -> status = '再申請中';
            }

            $approvals -> save();

            return redirect('/brochures/consent');
        }

        //
        public function search(Request $request)
        {
            // リクエストからキーワードを取得
            $keyword = $request->input('keyword');
            // クエリを作成
            $query = Approval::with('user','brochure');

            // キーワード（入力部分）が空でない場合、検索処理を実行
            if (!empty($keyword)) {
                $query->where('detail','like','%'.$keyword.'%')
                    ->orwhereHas('user',function ($query)  use ($keyword) {
                        $query -> where('name','like','%'.$keyword.'%');})
                    ->orwhereHas('brochure',function ($query)  use ($keyword) {
                        $query -> Where('name','like','%'.$keyword.'%');
                });

            // 10件表示
            $approvals = $query -> orderBy('id','asc') -> paginate(10);

            return view('/result',['approvals' => $approvals,'keyword' => $keyword]);
        }
    }
}
