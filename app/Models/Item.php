<?php
namespace App\Models;
// Modelクラスの宣言
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//itemsを単数形、アッパーキャメルケース
//Modelクラスを継承
class Item extends Model
{
    // created_atとupdated_atの自動挿入を無効にする
    public $timestamps = false;

    // INSERT、UPDATEで許可するカラムを指定
    protected $fillable = [
        "name",
        "price",
        "category_id"
    ];

    public function category(): BelongsTo
    {
        // Categoryモデルとのリレーションを定義
        return $this->belongsTo(Category::class);
    }
}
