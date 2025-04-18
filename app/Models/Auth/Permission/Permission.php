<?php

namespace App\Models\Auth\Permission;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Role\Role;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
