<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a permission can be created.
     *
     * @return void
     */
    public function test_permission_can_be_created()
    {
        $permission = Permission::create([
            'name' => 'view-users',
            'display_name' => 'Voir les utilisateurs',
            'description' => 'Permission pour voir les utilisateurs',
        ]);

        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals('view-users', $permission->name);
        $this->assertEquals('Voir les utilisateurs', $permission->display_name);
        $this->assertEquals('Permission pour voir les utilisateurs', $permission->description);
    }

    /**
     * Test if a permission can be assigned to a role.
     *
     * @return void
     */
    public function test_permission_can_be_assigned_to_role()
    {
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrateur',
            'description' => 'Role pour les administrateurs',
        ]);

        $permission = Permission::create([
            'name' => 'view-users',
            'display_name' => 'Voir les utilisateurs',
            'description' => 'Permission pour voir les utilisateurs',
        ]);

        $role->permissions()->attach($permission);

        $this->assertEquals(1, $role->permissions()->count());
        $this->assertEquals('view-users', $role->permissions->first()->name);
    }
}