<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    protected $table = 'vacaciones';
  
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
  
    public function scopeNombre($query, $nombre) {
        if(trim($nombre) != "") {
            $query->whereHas('user', function($q) use($nombre) {
                $q->where('name', 'like', '%'.$nombre.'%');
            });
        }
    }
    
    public function scopeApellido($query, $apellido) {
        if(trim($apellido) != "") {
            $query->whereHas('user', function($q) use($apellido) {
                $q->where('apellido', 'like', '%'.$apellido.'%');
            });
        }
    }
  
    public function scopeMisEmpleados($query, $idJefe) {
        if(trim($idJefe) != "") {
            $query->whereHas('user', function($q) use($idJefe) {
                $q->where('jefe_id', $idJefe);
            });
        }
    }

    
}
