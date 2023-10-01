<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Brochure;

use function App\Models\Approval;

class WorkFlowController extends Controller
{
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

        // 申請一覧画面表示
        public function Consent(Request $request)
        {
            $approvals = approval::all();

            return view('Consent',[
                'approvals' => $approvals
            ]);
        }
        public function approval($id)
        {
            $approvals = approval::findOrFail($id);
            // カラムの値を承認に変更
            $approvals -> status = '承認';
            // 保存
            $approvals -> save();

            $approvedQuantity = $approvals -> quantity;

            $brochure = Brochure::findOrFail($approvals -> brochure_id);

            $Quantity = $brochure -> quantity - $approvedQuantity;

            $brochure -> update(['quantity' => $Quantity]);

            // 決裁履歴へ遷移
            return redirect('/brochures/result');
        }
        public function disapproval($id)
        {
            $approvals = Approval::findOrFail($id);
            // カラムの値を承認に変更
            $approvals -> status = '差戻';
            // 保存
            $approvals -> save();

            return redirect('/brochures/result');
        }
        public function result(Request $request)
        {
            $approvals = Approval::all();

            return view('result',[
                'approvals' => $approvals
            ]);
        }
        // 一度、承認した申請を差し戻す
        public function remand($id)
        {
            $approvals = Approval::findOrFail($id);
            // カラムの値を申請中に変更
            $approvals -> status = '差戻';
            // 保存
            $approvals -> save();

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
}