<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
        "role"
    ];

    protected $hidden = [
        "password"
    ];

    public function scopeWithAll(Builder $query)
    {
        $query->with(["clients", "recovery_token"]);
    }

    public function clients()
    {
        return $this->hasManyThrough(Client::class, UserClient::class, "client_id", "id", "id", "user_id");
    }

    public function recovery_token()
    {
        return $this->hasOne(PasswordRecoveryToken::class);
    }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value = "")
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }
}
