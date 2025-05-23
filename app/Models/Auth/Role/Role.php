<?php

namespace App\Models\Auth\Role;

use App\Models\User\User;
use App\Models\Auth\Permission\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeFilter($query, $name = null)
    {
        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }

        return $query;
    }
}
