<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active'
    ];

    protected $with = [
        'perfilUsuario',
        // 'supervisor',
   
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function perfilUsuario(){
        return $this->belongsTo('App\Perfil', 'perfil');
    }

    public function supervisor(){
        return $this->belongsTo('App\User', 'supervisor');
    }


    // public function supervisionados($id = 0){
    //     if($id == 0){
    //         $id = $this->id;
    //     }

    //     $usuariosSubordinados = User::where('supervisor', $id)->get();
    //     return $usuariosSubordinados;
    // }
   
    public function supervisionados(){
        return $this->hasMany('App\User', 'supervisor');
    }



}
