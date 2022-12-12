<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->string('unidade');
            $table->string('equipe');
            $table->string('acs');
            $table->string('usuario');
            $table->date('dn');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('mv_solicitacao');
            $table->string('relacao_caso');
            $table->BigInteger('usuario_id');
           
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form');
    }
}
