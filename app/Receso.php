<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Receso extends Model
{
      protected $fillable = [
        'asistencia_id', 'start_date', 'end_date' ,'status','descanso'
    ];
  
  public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
}
