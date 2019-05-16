<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Revision extends Model
{
  protected $guarded = ['id'];
    
    public function getTotalCSPAttribute()
    {
        return ($this->total1 * $this->desenpeno->peso_oindividuales)/100;
    }
    public function getTotalAdmonAttribute()
    {
        return ($this->total2 * $this->desenpeno->peso_oadmon)/100;
    }
    public function getTotalCulturaAttribute()
    {
        return ($this->total3 * $this->desenpeno->peso_ocultura)/100;
    }
    public function getTotalAttribute()
    {
        return $this->totalCSP + $this->totalAdmon + $this->totalCultura;
    }
  
  public function desenpeno()
    {
        return $this->belongsTo('App\Desenpeno');
    }
    
}
