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
            $table->string('prof_sol');
            $table->date('dn');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('mv_solicitacao');
            $table->string('relacao_caso');
            $table->BigInteger('enviado')->default(0);
            $table->date('data_enviado')->nullable();
            $table->BigInteger('usuario_id');
            $table->string('comentario')->nullable();
            $table->string('avaliacao')->nullable();
            $table->string('outros')->nullable();
            $table->BigInteger('nasf_id')->nullable();
            $table->string('nasf_nome')->nullable();
            $table->BigInteger('comentario_enviado')->nullable();
            $table->date('data_coment')->nullable();
            
            

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
