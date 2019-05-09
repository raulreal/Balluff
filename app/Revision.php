<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Revision extends Model
{
  protected $guarded = ['id'];
  
  public function desenpeno()
    {
        return $this->belongsTo('App\Desenpeno');
    }
    
}
