<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        "project_id",
        "title",
        "type",
        "info",
        "gateway",
        "port",
        "user",
        "password"
    ];

    public function scopeWithAll(Builder $query)
    {
        $query->with(["project", "files"]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        return $this->hasManyThrough(File::class, CredentialFile::class, "file_id", "id", "id", "credential_id");
    }

    public function setGatewayAttribute($value)
    {
        if($value){
            $this->attributes['gateway'] = Crypt::encryptString($value);
        }
    }

    public function setPortAttribute($value)
    {
        if($value){
            $this->attributes['port'] = Crypt::encryptString($value);
        }
    }

    public function setUserAttribute($value)
    {
        if($value){
            $this->attributes['user'] = Crypt::encryptString($value);
        }
    }

    public function setPasswordAttribute($value)
    {
        if($value){
            $this->attributes['password'] = Crypt::encryptString($value);
        }
    }

    public function getGatewayAttribute()
    {
        if($this->attributes['gateway']){
            return Crypt::decryptString($this->attributes['gateway']);
        }
    }

    public function getPortAttribute()
    {
        if($this->attributes['port']){
            return Crypt::decryptString($this->attributes['port']);
        }
    }

    public function getUserAttribute()
    {
        if($this->attributes['user']){
            return Crypt::decryptString($this->attributes['user']);
        }
    }

    public function getPasswordAttribute()
    {
        if($this->attributes['password']){
            return Crypt::decryptString($this->attributes['password']);
        }
    }
}
