<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Auth\Permission\Permission;
use App\Models\Auth\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoleByName($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function hasRole($roles)
    {
        if ($roles instanceof \Illuminate\Database\Eloquent\Collection) {
            return $this->roles()->whereIn('id', $roles->pluck('id'))->exists();
        }
    }

    public function scopeFilter($query, $name, $email)
    {
        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($email) {
            $query->where('email', 'like', "%{$email}%");
        }

        return $query;
    }
}
