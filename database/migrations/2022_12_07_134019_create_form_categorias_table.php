<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_categorias', function (Blueprint $table) {
            $table->id();

            $table->BigInteger('form_id')->unsigned();
            $table->Biginteger('categorias_id')->unsigned();

            $table->foreign('form_id')->references('id')->on('form')->onDelete('cascade');
            $table->foreign('categorias_id')->references('id')->on('categorias')->onDelete('cascade');

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
        Schema::dropIfExists('form_categorias');
    }
}
