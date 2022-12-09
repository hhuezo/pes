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
        /*  Permission::create( ['name' => 'create roles'] );
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

        Permission::create( ['name' => 'create employer'] );
        Permission::create( ['name' => 'read employer'] );
        Permission::create( ['name' => 'edit employer'] );
        Permission::create( ['name' => 'delete employer'] );
        Permission::create( ['name' => 'read admin employer'] );

        Permission::create( ['name' => 'create job application'] );
        Permission::create( ['name' => 'read job application'] );
        Permission::create( ['name' => 'edit job application'] );
        Permission::create( ['name' => 'delete job application'] );
        Permission::create( ['name' => 'read admin job application'] );







        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo(Permission::all());*/

       /* $consulta = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
        ]);
        $consulta->assignRole('administrator');

        $role = Role::create(['name' => 'administrator pes']);
        $role = Role::create(['name' => 'applicant']);
        $role = Role::create(['name' => 'recruiter']);
        $role = Role::create(['name' => 'company']);

        $consulta = User::create([
            'name' => 'aaron',
            'email' => 'aaron@mail.com',
            'password' => bcrypt('12345678'),
        ]);
        $consulta->assignRole('administrator pes');*/




        $role = Role::findByName('administrator pes');
        $role->givePermissionTo( 'read employer', 'edit employer', 'create job application', 'read job application','edit job application');

        $role = Role::findByName('employer');
        $role->givePermissionTo( 'read employer', 'edit employer', 'read admin employer','create job application','read admin job application', 'read job application','edit job application');









        /* Permission::create( ['name' => 'create employer'] );
        Permission::create( ['name' => 'read employer'] );
        Permission::create( ['name' => 'edit employer'] );
        Permission::create( ['name' => 'delete employer'] );
        Permission::create( ['name' => 'read admin employer'] );

        Permission::create( ['name' => 'create job application'] );
        Permission::create( ['name' => 'read job application'] );
        Permission::create( ['name' => 'edit job application'] );
        Permission::create( ['name' => 'delete job application'] );
        Permission::create( ['name' => 'read admin job application'] );
 */
    }
}
