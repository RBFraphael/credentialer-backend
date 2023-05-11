<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordRecoveryToken extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "token",
        "expiration"
    ];

    protected static function booted()
    {
        static::addGlobalScope("valid", function(Builder $builder){
            $builder->where("expiration", "<=", date("Y-m-d H:i:s"));
        });
    }

    public function scopeWithAll(Builder $query)
    {
        $query->with(["user"]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
