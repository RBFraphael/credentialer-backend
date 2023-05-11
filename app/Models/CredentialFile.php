<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "credential_id",
        "file_id"
    ];

    public function scopeWithAll(Builder $query)
    {
        $query->with(["credential", "file"]);
    }

    public function credential()
    {
        return $this->belongsTo(Credential::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
