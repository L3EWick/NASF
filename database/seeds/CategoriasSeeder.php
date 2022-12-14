<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nome' => 'Serviço Social'
           
        ]); 
        DB::table('categorias')->insert([
            'nome' => 'Psicologia'
           
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Nutrição'
           
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Fisioterapia'
           
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Fonoaudiologia'
           
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Sanitarista'
           
        ]);
        DB::table('categorias')->insert([
            'nome' => 'Pólo Academia da Saúde'
           
        ]);
    }
}

