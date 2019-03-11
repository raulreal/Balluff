<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
  
  //protected $appends = ['is_admin'];
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  
  public function desenpeno()
    {
        return $this->hasOne('App\Desenpeno');
    
    }
  
    public function ingreso()
    {
        return $this->hasOne('App\Ingreso');
    
    }
  
   public function viajera()
    {
        return $this->hasOne('App\Viajera');
    
    }
  
  public function asistencias()
    {
        return $this->hasMany('App\Asistencia');
    }

   public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }
  
  public function misEmpleados()
    {
        return $this->hasMany('App\User', 'jefe_id');
    }
  
  public function miJefe()
    {
        return $this->belongsTo('App\User', 'jefe_id');
    }
  
  /*+++++++++++ Filtros +++++++++++++++*/
  
  public function scopeNombre($query, $nombre) {
    	if(trim($nombre) != "") {
    		  $query->where('name', 'like', '%'.$nombre.'%');
      }
  }
  
  public function scopeApellido($query, $apellido) {
    	if(trim($apellido) != "") {
    	  	$query->where('apellido', 'like', '%'.$apellido.'%');
      }
  }
    /*
  public function scopeFechasNoDisponibles($query, $fechaViaje){
    	if(trim($fechaViaje) != "") {
    		$query->where(function ($q) use($fechaViaje) {
                      $q->where([ ['fecha_no_disponible1', '>', $fechaViaje], ['fecha_no_disponible2', '>', $fechaViaje] ])
    		                ->orWhere([ ['fecha_no_disponible1', '<', $fechaViaje], ['fecha_no_disponible2', '<', $fechaViaje] ]);
                  });
        }
  }
  */
  
  
  
  
}


