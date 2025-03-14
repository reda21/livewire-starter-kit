<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Get the roles associated with the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the users associated with the permission.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Assign a role to the permission.
     */
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    /**
     * Sync roles to the permission.
     */
    public function syncRoles($roles)
    {
        return $this->roles()->sync($roles);
    }

    /**
     * Remove a role from the permission.
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Get the names of the roles directly assigned to the permission.
     */
    public function getRoleNames()
    {
        return $this->roles->pluck('name');
    }

    /**
     * Scope the query to certain roles.
     */
    public function scopeRole($query, $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    /**
     * Scope the query to users without certain roles.
     */
    public function scopeWithoutRole($query, $role)
    {
        return $query->whereDoesntHave('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    /**
     * Scope the query to users with certain permissions.
     */
    public function scopePermission($query, $permission)
    {
        return $query->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        });
    }

    /**
     * Scope the query to users without certain permissions.
     */
    public function scopeWithoutPermission($query, $permission)
    {
        return $query->whereDoesntHave('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        });
    }
}
