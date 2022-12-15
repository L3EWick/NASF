<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ismael',
            'email' => 'ismael.limaa@mesquita.rj.gov.br',
            'nivel' => 'Medico',
            'password' => '$2y$10$eMMXLkP579E/hf8.oSBJRu.yndQDIU0XrjRsY/R9Sr6hxzjToy0gC', //teste123
        ]);
        DB::table('users')->insert([
            'name' => 'Ismael',
            'email' => 'ismael.limao@mesquita.rj.gov.br',
            'nivel' => 'Nasf',
            'password' => '$2y$10$eMMXLkP579E/hf8.oSBJRu.yndQDIU0XrjRsY/R9Sr6hxzjToy0gC', //teste123
        ]);
        DB::table('users')->insert([
            'name' => 'Ismael',
            'email' => 'ismael.lima@mesquita.rj.gov.br',
            'nivel' => 'Admin',
            'password' => '$2y$10$eMMXLkP579E/hf8.oSBJRu.yndQDIU0XrjRsY/R9Sr6hxzjToy0gC', //teste123
        ]);
    }
}
    

