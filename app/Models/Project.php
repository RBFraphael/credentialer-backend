<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_id",
        "title"
    ];

    public function scopeWithAll(Builder $query)
    {
        $query->with(["client", "credentials"]);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function credentials()
    {
        return $this->hasMany(Credential::class);
    }
}
