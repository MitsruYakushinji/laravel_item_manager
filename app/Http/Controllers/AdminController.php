<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Department;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // 管理者一覧ページ表示
    public function index()
    {
        // クエリビルダーでのデータ取得
        $sql = Admin::query();

        // deleted_atがNULLのものだけ取得
        $sql->whereNull('deleted_at');

        // adminクラス(モデル)を介してadminテーブルのデータを全件取得
        $admins = $sql->get();
        return view("admin.admins", ['admins' => $admins]);
    }

    // 管理者新規登録ページ表示
    public function showAdd()
    {
        $departments = Department::all();
        return view('admin.add', ['departments' => $departments]);
    }

    // 管理者新規登録処理
    public function add(CreateAdminRequest $request)
    {
        $admin = new Admin();

        if($admin->fill($request->all())->save()){
            Log::info('管理者の登録が正常に行われました', ['admin_id' => $admin->id]);
            return redirect('/admins');
        }
        Log::error('管理者の登録ができませんでした', ['data' => $request->all()]);
        return redirect('/admins');
    }

    // 管理者編集ページ表示
    public function showEdit($id)
    {
        $admin = Admin::find($id);

        $departments = Department::all();

        return view('admin.edit', [
            'admin' => $admin,
            'departments' => $departments
        ]);
    }

    // 管理者編集処理
    public function edit($id, Request $request)
    {
        $admin = Admin::find($id);

        $admin->fill($request->all())->save();
        return redirect('/admins');
    }

    // 管理者削除処理(論理)
    public function delete($id ,Request $request)
    {
        // 管理者データを1件取得
        $admin = Admin::find($id);

        // 現在日次を取得
        $date = date('Y-m-d H:i:s');

        // deleted_atに現在日時を設定
        $admin->deleted_at = $date;
        $admin->save();

        // 管理者一覧ページにリダイレクト
        return redirect('/admins');
    }
}
