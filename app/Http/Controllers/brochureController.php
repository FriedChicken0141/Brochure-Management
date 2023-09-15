<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brochure;
use App\Models\Area;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        $brochures = brochure::sortable()->paginate(20);
        $areas = area::all();


        return view('index',[
            'brochures' => $brochures,
            'areas' => $areas
        ]);
    }

    // brochuresテーブルからidを取得後、プレビュー画面を表示
    public function cover($id)
    {
        $brochure = brochure::findOrFail($id);

        return view('cover',[
            'brochure' => $brochure,
        ]);
    }

    // areasテーブルから情報を取得後、新規登録画面を表示
    public function register(Request $request)
    {
        $areas = Area::all();

        return view('register',['areas' => $areas]);
    }

    // パンフレット登録
    public function add(Request $request)
    {
        // userテーブルからidを取得
        $user_id = auth() -> user() -> id;

        // ディレクトリ名
        $dir = 'cover';
        // アップロードされたファイル名を取得
        $request -> file('image')->getClientOriginalName();
        // coverディレクトリに画像を保存
        $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => $dir,]);

        // $img_path = $request -> file('image') -> store('public/' . $dir);

        // DBへ登録
        brochure::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'area_id' => $request->area_id,
            'quantity' => $request->quantity,
            'detail' => $request->detail,
            'img_path' =>  $uploadedFile->getSecurePath(),
            'img_public_id' => $uploadedFile->getPublicId(),
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
        $brochure = Brochure::findOrFail($request -> id);

        // ディレクトリ名
        $dir = 'cover';

        // 画像の添付があれば、アップロードされたファイル名を取得
        if (!empty($request -> file('image'))){
            $newImageName = $request -> file('image')->getClientOriginalName();
        // coverディレクトリに画像を保存
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => $dir,]);
        // 以前の画像ファイル名を取得
            $oldImageName = basename($brochure -> img_path);
        // 古い画像の名前と新しい画像の名前が一致しなければ、古い画像を削除
            if($oldImageName !== $newImageName){
                Cloudinary::delete('public/' . $dir . '/' . $oldImageName);
            }

            $brochure -> name = $request -> name;
            $brochure -> area_id = $request -> area_id;
            $brochure -> quantity = $request -> quantity;
            $brochure -> detail = $request -> detail;
            $brochure -> img_path = $uploadedFile->getSecurePath();
            $brochure -> img_public_id = $uploadedFile->getPublicId();

            $brochure -> save();

        } else {
            // 画像添付がなければ、画像パスを除く部分を更新
            $brochure -> name = $request -> name;
            $brochure -> area_id = $request -> area_id;
            $brochure -> quantity = $request -> quantity;
            $brochure -> detail = $request -> detail;

            $brochure -> save();
        }

        return redirect('/brochures');
    }

    // パンフレット情報削除
    public function destroy(Request $request)
    {
        // ディレクトリ名
        $dir = 'cover';

        $brochure = Brochure::findOrFail($request -> id);

        // 画像名を取得
        $ImageName = basename($brochure -> img_path);

        $brochure -> delete();

        if (!empty($ImageName)){
            storage::delete('public/' . $dir . '/' . $ImageName);
        }

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

            // 検索検索を10件表示
            $brochures = $query -> orderBy('id','asc') -> paginate(10);

            return view('index',['brochures' => $brochures,'keyword' => $keyword]);

    }

}
