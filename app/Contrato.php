<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contrato extends Model
{
  protected $guarded = ['id'];
  
    public function user()
    {
        return $this->belongsTo('App\User');
    }
  
    public function getDiffAttribute()
    {
          $date = Carbon::parse($this->duracion);
          $now = Carbon::now();
          $diff1 = $date->diffInDays($now);
          $dias = $date->diffInDays($now);
  
                if ($diff1 < 30   ) {  $diff = 'red';
                 } elseif ($diff1 > 30 && $diff1 < 90) { $diff = 'yellow';
                 } else { $diff = 'green' ;
                 }

          return $diff;
    }
  
    public function actualizacion()
    {
        return $this->hasMany('App\Actualizacion');
    }

      public function scopeStatus($query, $status) {
            if(trim($status) != "") {
                  $query->where('status', $status);
          }
      }
  
      public function scopeCategoria($query, $categoria) {
            if(trim($categoria) != "") {
                $query->where('categoria', 'like', '%'.$categoria.'%');
          }
      }
      
    public function scopeNombre($query, $nombre) {
          if(trim($nombre) != "") {
              $query->where('nombre', 'like', '%'.$nombre.'%');
          }
    }
  
    public function misActualizaciones()
    {
        return $this->hasMany('App\Contrato', 'act_id');
    }
  

  public function miActualizacion()
    {
        return $this->belongsTo('App\Contrato', 'act_id');
    }
        
}
