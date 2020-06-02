<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role_customer = new Role();
       $role_customer->name = 'customer';
       $role_customer->description = 'A customer User';
       $role_customer->save();

       $role_manager = new Role();
       $role_manager->name = 'admin';
       $role_manager->description = 'A Admin User';
       $role_manager->save();
    }
}
