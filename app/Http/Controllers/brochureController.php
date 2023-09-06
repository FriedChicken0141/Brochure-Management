<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brochure;
use App\Models\Area;
use App\Models\brochure as ModelsBrochure;

class brochureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 一覧
     */
    public function index(Request $request)
    {
        $brochures = brochure::all();
        $areas = area::all();

        return view('index',[
            'brochures' => $brochures,
            'areas' => $areas
        ]);
    }

    // areasテーブルから情報を取得後、新規登録画面を表示
    public function register(Request $request)
    {
        $areas = Area::all();

        return view('register',['areas' => $areas]);
    }

    // パンフレット登録【修正済み】
    public function add(Request $request)
    {
        // userテーブルからidを取得
        $user_id = auth() -> user() -> id;

        // DBへ登録
        brochure::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'area_id' => $request->area_id,
            'quantity' => $request->quantity,
            'detail' => $request->detail,
        ]);

            return redirect('/brochures');
    }

    // パンフレット編集画面
    public function edit(Request $request)
    {
        $brochures = Brochure::findOrFail($request -> id);
        $areas = Area::all();

        return view('edit',['brochures' => $brochures,'areas' => $areas]);
    }

    // 編集した情報を渡す
    public function update(Request $request)
    {
        $brochures = Brochure::findOrFail($request -> id);
        $brochures -> name = $request -> name;
        $brochures -> area_id = $request -> area_id;
        $brochures -> quantity = $request -> quantity;
        $brochures -> detail = $request -> detail;

        $brochures -> save();

        return redirect('/brochures');
    }

    // パンフレット情報削除
    public function destroy(Request $request)
    {
        $brochures = Brochure::findOrFail($request -> id);
        $brochures -> delete();

        return redirect('/brochures');
    }

    // 検索機能
    public function search(Request $request)
    {
        // リクエストからキーワードを取得
        $keyword = $request->input('keyword');
        // クエリを作成
        $query = Brochure::with('area');

        // キーワード（入力部分）が空でない場合、検索処理を実行
        if (!empty($keyword)) {
            $query->where('id','like','%'.$keyword.'%')
                ->orWhere('name','like','%'.$keyword.'%')
                ->orWhereHas('area', function ($query) use ($keyword) {
                    $query->where('area_name','like','%'.$keyword.'%')
                ->orWhere('detail','like','%'.$keyword.'%');
                });
            }

            // 検索検索を◯件表示
            $brochures = $query -> orderBy('id','asc') -> paginate(10);

            return view('index',['brochures' => $brochures,'keyword' => $keyword]);

    }

}
