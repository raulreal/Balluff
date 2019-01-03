<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'start_date', 'abierto'
    ];
  
  public function recesos()
    {
        return $this->hasMany('App\Receso');
    }
  
    public function user()
    {
        return $this->belongsTo('App\User');
    
    }
  
}
