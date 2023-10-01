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
            // 決裁履歴へ遷移
            return redirect('/brochures/result');
        }
        public function disapproval($id)
        {
            $approvals = approval::findOrFail($id);
            // カラムの値を承認に変更
            $approvals -> status = '否認';
            // 保存
            $approvals -> save();

            return redirect('/brochures/result');
        }
        public function result(Request $request)
        {
            $approvals = approval::all();

            return view('result',[
                'approvals' => $approvals
            ]);
        }
        public function remand($id)
        {
            $approvals = approval::findOrFail($id);
            // カラムの値を承認に変更
            $approvals -> status = '申請中';
            // 保存
            $approvals -> save();
            // 申請一覧へ遷移
            return redirect('/brochures/consent');
        }
}
