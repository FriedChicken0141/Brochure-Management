<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brochure;
use App\Models\Area;


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
        $brochures = brochure::with('area') -> get();
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
            'area' => $request -> area,
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
        $brochures -> area = $request -> area;
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

}
