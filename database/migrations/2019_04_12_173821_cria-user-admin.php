<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaUserAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $novoUsuario = new \App\User;
        $novoUsuario->name = 'Super admin';
        $novoUsuario->email = 'admin@admin.com';
        $novoUsuario->password = \bcrypt('leandro-jinn01');
        $novoUsuario->active = 1;
        $novoUsuario->perfil = 4;
       
        $novoUsuario->save();
      
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
