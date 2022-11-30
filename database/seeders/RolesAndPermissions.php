<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* Permission::create( ['name' => 'create roles'] );
        Permission::create( ['name' => 'read roles'] );
        Permission::create( ['name' => 'edit roles'] );
        Permission::create( ['name' => 'delete roles'] );
        Permission::create( ['name' => 'create users'] );
        Permission::create( ['name' => 'read users'] );
        Permission::create( ['name' => 'edit users'] );
        Permission::create( ['name' => 'delete users'] );
        Permission::create( ['name' => 'create permissions'] );
        Permission::create( ['name' => 'read permissions'] );
        Permission::create( ['name' => 'edit permissions'] );
        Permission::create( ['name' => 'delete permissions'] );

        $role = Role::create( ['name' => 'administrator'] );
        $role->givePermissionTo( Permission::all() );

        $role = Role::create( ['name' => 'administrator pes'] );
        $role = Role::create( ['name' => 'applicant'] );
        $role = Role::create( ['name' => 'recruiter'] );
        $role = Role::create( ['name' => 'company'] );*/

        $consulta = User::create( [
            'name'=>'aaron',
            'email'=>'aaron@mail.com',
            'password'=> bcrypt( '12345678' ),
        ] );
        $consulta->assignRole('administrator pes');

    }
}
