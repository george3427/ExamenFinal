<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'user_id' => 1,
            'rol_tipo' => 'admin',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Editor',
            'email' => 'editor@editor.com',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'user_id' => 2,
            'rol_tipo' => 'editor',
        ]);


        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Usuario',
            'email' => 'usuario@usuario.com',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'user_id' => 3,
            'rol_tipo' => 'usuario',
        ]);
    }
}
