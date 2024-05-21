<?php
namespace App\Http\Controllers;

use App\Http\Requests\EditItemRequest;
use App\Http\Requests\EditStockRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\CreateItemRequest;


class ItemController extends Controller
{
    // 商品一覧ページの表示
    public function index(Request $request)
    {
        // クエリビルダーでのデータ取得
        $sql = Item::query();

        // リクエストを取得してわかりやすいように変数に代入
        $re = $request->all();

        // リクエストにnameが含まれなければWHEREを追加
        if (!empty($re['name'])) {
            $sql->where('name', $re['name']);
        }

        // リクエストにpriceが含まれなければWHEREを追加
        if (!empty($re['price'])) {
            $sql->where('price', $re['price']);
        }

        // リクエストにsortが含まれていればORDER BYを追加
        if (!empty($re['sort'])) {
            $sql->orderBy($re['sort'], $re['sort_type']);
        }

        // deleted_atがNULLのものだけ取得
        $sql->whereNull('deleted_at');

        // get()を実行し、データを取得
        $items = $sql->get();

        // 画面で利用する変数として$itemsを連想配列として渡す
        return view('item.index', ['items' => $items]);
    }

    // 商品新規登録ページの表示用
    public function showAdd()
    {
        $categories = Category::all();
        return view('item.add', ['categories' => $categories]);
    }

    // 商品新規登録処理
    public function add(CreateItemRequest $request)
    {
        $item = new Item();

        // リクエストからModelの$fillableに設定したプロパティのみを抽出・保存
        if ($item->fill($request->all())->save()) {
            Log::info('商品の登録が正常に行われました', ['item_id' => $item->id]);
            return redirect('/item');
        }
        Log::error('商品の登録ができませんでした', ['data' => $request->all()]);
        // 商品一覧ページ(http://localhost/item_manager/public/item)にリダイレクト
        return redirect('/item');
    }

    // 商品編集ページの表示
    public function showEdit($id)
    {
        // 商品データを1件取得
        $item = Item::find($id);

        // categoryから全件取得
        $categories = Category::all();

        // 画面で利用する変数として$itemを連想配列で渡す
        return view('item.edit', [
            'item' => $item,
            "categories" => $categories
        ]);
    }

    // 商品編集処理
    public function edit($id, EditItemRequest $request)
    {
        // 商品データを1件取得
        $item = Item::find($id);

        // リクエストからModelの$fillableに設定したプロパティのみを抽出・保存
        $item->fill($request->all())->save();

        // 商品一覧ページ(http://localhost/item_manager/public/item)にリダイレクト
        return redirect('/item');
    }

    // 商品削除(論理)
    public function delete($id)
    {
        // 商品データを1件取得
        $item = Item::find($id);

        // // 商品データを削除
        // $item->delete();

        // 現在日次を取得、フォーマットを変換
        $date = date("Y-m-d H:i:s");

        // deleted_atに現在日時を設定
        $item->deleted_at = $date;
        $item->save();

        // 商品一覧ページ(http://localhost/item_manager/public/item)にリダイレクト
        return redirect('/item');
    }

    // 在入出荷処理
    public function editStock(EditStockRequest $request, $id)
    {
        Log::info('Request data:', $request->all());
        // URLのIDを利用してItemモデルから1件取得
        $item = Item::find($id);

        // $requestから入力された在庫数を取得
        $stock = collect($request->input('stock'))->values()->first();
        // $requestから対象となる商品を特定するkeyを取得
        $key = collect($request->input('stock'))->keys()->first();

        // 入荷の場合
        if ($request->has('in')) {
            // 商品の在庫数に$stockを加算
            $item->stock += $stock;

            //出荷の場合
        } else if ($request->has('out')) {
            // 在庫数が0の状態で出荷をする場合
            if ($item->stock == 0) {
                // バリデーションエラーのメッセージを投げる
                throw ValidationException::withMessages([
                    'stock.' . $key => '在庫がありません。'
                ]);
            } else if ($item->stock < $stock) {
                // バリデーションエラーのメッセージを投げる
                throw ValidationException::withMessages([
                    'stock.' . $key => '出荷数は在庫数以下の入力をしてください。'
                ]);
            } else {
                // 商品の在庫数から$stockを減算
                $item->stock -= $stock;
            }
        }

        // 在庫数の変動を保存
        $item->save();

        // 商品一覧ページ(http://localhost/item_manager/public/item)にリダイレクト
        return redirect('/item');
    }

    // 認証済みユーザー詳細情報ページの表示
    public function detail()
    {
        return view('item.detail');
    }
}
