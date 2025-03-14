<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
     * Get the permissions associated with the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get the users associated with the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Assign a permission to the role.
     */
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * Sync permissions to the role.
     */
    public function syncPermissions($permissions)
    {
        return $this->permissions()->sync($permissions);
    }

    /**
     * Revoke a permission from the role.
     */
    public function revokePermissionTo($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * Get the names of the permissions directly assigned to the role.
     */
    public function getPermissionNames()
    {
        return $this->permissions->pluck('name');
    }

    /**
     * Get the permissions directly assigned to the role.
     */
    public function getDirectPermissions()
    {
        return $this->permissions;
    }

    /**
     * Get the permissions assigned to the role via roles.
     */
    public function getPermissionsViaRoles()
    {
        return $this->users->flatMap(function ($user) {
            return $user->permissions;
        })->unique();
    }

    /**
     * Get all permissions for the role.
     */
    public function getAllPermissions()
    {
        return $this->getDirectPermissions()->merge($this->getPermissionsViaRoles());
    }

    /**
     * Get the names of the role's users.
     */
    public function getRoleNames()
    {
        return $this->users->pluck('name');
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
