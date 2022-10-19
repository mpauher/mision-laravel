<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // create permissions
        Permission::create(['name' => 'edit movie']);
        Permission::create(['name' => 'delete movie']);
        Permission::create(['name' => 'list movies']);
        Permission::create(['name' => 'show movie']);
        Permission::create(['name' => 'search movie']);

        // this can be done as separate statements

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('list movies');
        $user->givePermissionTo('show movie');
        $user->givePermissionTo('search movie'); 
    }
}
