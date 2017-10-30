<?php

namespace App\Farmer\Traits;

use App\Farmer\Models\Permission;
use App\Farmer\Models\Role;

trait HasRoles {
    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Toggle the given role to the user.
     *
     * @param mixed $role
     */
    public function toggleRole($role)
    {
        if (is_string($role)) {
            $result = Role::whereName($role)->firstOrFail();
            $this->roles()->toggle([$result->id]);
            return;
        }
        $this->roles()->toggle([$role->id]);
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return (bool) $role->intersect($this->roles)->count();
    }
    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }
}