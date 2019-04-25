<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Criacliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa')->unsigned()->nullable();
            $table->foreign('empresa')->references('id')->on('empresa');
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('orgao')->nullable();
            $table->string('beneficio')->nullable();
            $table->string('uf')->nullable();
            $table->string('cidade')->nullable();
            $table->double('salario')->nullable();
            $table->bigInteger('ultimo')->unsigned()->nullable();
            $table->foreign('ultimo')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
