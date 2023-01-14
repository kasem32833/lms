<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $defaultPermissions = ['Lead-management',  'create-admin'];

        foreach($defaultPermissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $this->create_user_with_role('Super Admin', 'Super Admin', 'superadmin@lms.test');
        $this->create_user_with_role('Communication', 'Communication Team', 'communication@lms.test');
        $teacher = $this->create_user_with_role('Teacher', 'Teacher', 'teacher@lms.test');
        $this->create_user_with_role('Leads', 'Leads', 'leads@lms.test');


        // create leads
        Lead::factory(100)->create();

        //course create
        $course = Course::create([
            'name' => 'Laravel',
            'description'=> 'This is a laravel course designed and developed by rasel ahmed its a great course and',
            'image' => 'https://laravel.com/img/logomark.min.svg',
            'user_id' => $teacher->id
        ]);

        // create curriculum
        Curriculum::factory(10)->create();

    }
    // dynamic function for create user with role
    private function create_user_with_role($type, $name, $email,){
        $role =Role::create([
            'name' => $type
        ]);
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('password')
        ]);
        $user->assignRole($role);


        if($type == 'Super Admin'){
            $role->givePermissionTo(Permission::all());
        }elseif($type == 'Leads'){
            $role->givePermissionTo('Lead-management');
        }
        return $user;

    }
}
