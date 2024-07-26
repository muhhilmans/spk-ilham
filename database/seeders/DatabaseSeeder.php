<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
        ]);

        $admin = User::create([
           'name' => 'Admin',
           'username' => 'admin',
           'email' => 'admin@example.com',
           'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        $teacher = User::create([
            'name' => 'Guru',
            'username' => 'guru',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'),
        ]);

        $teacher->assignRole('guru');

        $student = User::create([
            'name' => 'Siswa',
            'username' => 'siswa',
            'email' => 'siswa@example.com',
            'password' => bcrypt('password'),
        ]);

        $student->assignRole('siswa');
        
        DB::table('students')->insert([
            'user_id' => $student->id,
        ]);
    }
}
