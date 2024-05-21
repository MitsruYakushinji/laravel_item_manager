<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "name",
        "department_id"
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
