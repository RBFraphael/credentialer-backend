<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "logo_file_id"
    ];

    protected $appends = [
        "logo"
    ];

    public function getLogoAttribute()
    {
        return File::find($this->logo_file_id);
    }

    public function scopeWithAll(Builder $query)
    {
        $query->with(["projects"]);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
