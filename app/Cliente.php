<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'cliente';
    protected $with = [
        'contatos',
        'empresa'
   
    ];

    function saveDD(){
        $this->ultimo = \Auth::user()->id;
        $this->save();
    }

    public function ultimo(){
        return $this->belongsTo('App\User', 'ultimo');
    }

    public function empresa(){
        return $this->belongsTo('App\Empresa', 'empresa');
    }

    public function contatos(){
        return $this->hasMany('App\Contato', 'cliente');
    }
}
