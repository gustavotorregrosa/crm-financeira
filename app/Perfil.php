<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;
    protected $table = 'perfis';
    protected $fillable = ['nome'];

    public function getNomeAttribute($value)
    {
        return strtolower($value);
    }
    
}
