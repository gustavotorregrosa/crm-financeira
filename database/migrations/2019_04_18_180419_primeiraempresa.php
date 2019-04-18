<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Primeiraempresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $empresa = new \App\Empresa;
        $empresa->nomeinterno = 'Sede';
        $empresa->nomefantasia = 'Financeira MAIS!';
        $empresa->razaosocial = 'Financeira ltda.';
        $empresa->cidade = 'São Paulo';
        $empresa->cnpj = '123456789';
        $empresa->ativa = true;
        $empresa->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
