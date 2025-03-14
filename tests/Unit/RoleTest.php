<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a role can be created.
     *
     * @return void
     */
    public function test_role_can_be_created()
    {
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrateur',
            'description' => 'Role pour les administrateurs',
        ]);

        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals('admin', $role->name);
        $this->assertEquals('Administrateur', $role->display_name);
        $this->assertEquals('Role pour les administrateurs', $role->description);
    }

    /**
     * Test if a role can have permissions.
     *
     * @return void
     */
    public function test_role_can_have_permissions()
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