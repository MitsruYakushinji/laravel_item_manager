<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "name"
    ];

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }
}
