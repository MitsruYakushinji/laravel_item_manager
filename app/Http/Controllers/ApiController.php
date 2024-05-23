<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // 取得機能
    public function list()
    {
        // Itemモデルから全件取得
        $items = Item::all();
        // responseヘルパーのjsonメソッドを利用してreturnする
        return response()->json($items);
    }

    // 新規登録
    public function create(Request $request)
    {
        $item = new Item();
        $item->fill($request->all())->save();

        return $item;
    }

    // csrf用のトークンを発行
    public function token()
    {
        return csrf_field();
    }
}
